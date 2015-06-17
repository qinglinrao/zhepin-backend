<?php

use Illuminate\Routing\Controller;
use Dingo\Api\Routing\ControllerTrait;

class BaseController extends Controller
{
    use ControllerTrait;


    /** 返回JSON数据响应头
     * @param $state 返回状态码 默认1  （1或者0)
     * @param string $msg 返回信息 默认为空字符串
     * @return mixed
     */
    protected function setJsonMsg($state,$msg='',$other=array()){
        return Response::json(array_merge($other,array('state'=>$state,'msg'=>$msg)));
    }



    /**
     * @param $file input file 域对象
     * @param array $config  配置数组
     *          attr                = >  目标对象对应image表的字段 默认为"image_id"
     *          folder              = >  图片要上传的文件夹 默认为"Users"
     *          relation_image_name = >  目标对象对应image表的字段 默认为"image_id"
     *          width               = >  图片裁剪的宽度   (可选配置参数,与height同时设置才有效)
     *          height              = >  图片裁剪的高度   (可选配置参数,与width同时设置才有效)
     * @param null $obj     目标对象 默认为 null
     * @param bool $update_obj  是否更新目标对象 默认为 false
     * @param bool $del_orgin_image 是否删除目标对象 原关联的Image图片 默认为false
     * @throws Exception
     */
    protected  function uploadImage($file,$config,$update_obj = false,$del_orgin_image = false,$obj = null){


        $config = array_merge(array('attr'=>'image_id','folder'=>'Users','relation_image_name'=>'image'),$config);

        $name = time() . '.' . $file->getClientOriginalExtension();

        $file_size =  $file->getSize();
        $folder = 'uploads/'.$config['folder'].'/';
        mkFolder(Config::get('app.upload_dir') .'/'.$folder);
        $file->move(Config::get('app.upload_dir') .'/'.$folder, $name);
//        chmod(Config::get('app.upload_dir') .'/'.$folder.$name,0777);
//        Log::info('yes');
        if(isset($config['width']) && isset($config['height']))
            Img::make(Config::get('app.upload_dir') .'/'.$folder.$name)->resize($config['width'], $config['height'])->save(Config::get('app.upload_dir') .'/'.$folder . $name);
//        Log::info('yes2');
        $image = new Image();
        $image->name =  $name;
        $image->url = '/'.$folder . $name;
        $image->file_path = Config::get('app.upload_dir') .'/'.$folder. $name;
        $image->file_size = $file_size;
        $image->file_type = $file->getClientOriginalExtension();
        Log::info('yes3');
        try{

            DB::beginTransaction();
            $image->save();
            Log::info('image save');
            //如果有要操作的对象并且允许改变其image_id
            if($obj != null && $update_obj){
                $orgin_image = $obj->$config['relation_image_name'];
                $obj->$config['attr'] = $image->id;
                $obj->save();
                if($del_orgin_image && $orgin_image){
                    $orgin_image->delete();
                    $this->deleteFile($orgin_image->file_path);
                }
            }
            DB::commit();
            $image->url = AppHelper::imgSrc($image->url);
            return $image;

        }catch (Exception $e){
            DB::rollback();
            Log::info($e->getMessage());
            throw $e;
        }

    }


    protected  function deleteFile($file_path){
        if(file_exists($file_path)){
            @unlink($file_path);
        }
        return true;
    }
}
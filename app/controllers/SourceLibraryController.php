<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15-5-13
 * Time: 上午10:52
 */

class SourceLibraryController extends BaseController{

    //资源列表
    public function getSourceList(){
        $query = Input::get('query') ? trim(Input::get('query')) : '';
        $type = Input::get('type') ? Input::get('type') : '';
        $sources = SourceLibrary::domain();
        if($query){
            $sources = $sources->where('title','like','%'.$query.'%');
        }
        if($type){
            $sources = $sources->where('source_type',$type);
        }
        $sources = $sources->get();
        return View::make('sources.index',compact('sources','query','type'));
    }

    //转向文件添加页
    public function getAddArticle(){

        return View::make('sources.add_article');
    }

    //添加资源
    public function postSaveSource(){
        $data = Input::get('source');
        $rules = [
            'title' =>'required',
            'image_id' => 'required',
            'content' => 'required'
        ];
        $messages = array(
            'title.required' => '请填写标题',
            'image_id.required' => '请上传封面图',
            'content.required' => '请填写正文'
        );

        $v = Validator::make($data, $rules, $messages);

        if ($v->fails()) {
            return Redirect::back()->withInput()->withErrors(array('errors'=>$v->messages()->first()));
        }else{
            $source = new SourceLibrary();
            $source->fill($data);
            if($source->save()){
                return Redirect::route('sources.list');
            }else{
                return Redirect::back()->withInput()->withErrors(array('errors'=>"系统错误"));
            }
        }
    }

    //转向资源编辑页
    public function getEditSource($id){
        $source = SourceLibrary::domain()->whereId($id)->first();
        if($source->source_type ==1 ){
            return View::make('sources.edit_picture',compact('source'));
        }else{
            return View::make('sources.edit_article',compact('source'));
        }
    }

    //更新资源
    public function postUpdateSource($id){

        $data = Input::get('source');
        $rules = [
            'title' =>'required',
            'image_id' => 'required',
            'content' => 'required'
        ];
        $messages = array(
            'title.required' => '请填写标题',
            'image_id.required' => '请上传封面图',
            'content.required' => '请填写正文'
        );

        $v = Validator::make($data, $rules, $messages);

        if ($v->fails()) {
            return Redirect::back()->withInput()->withErrors(array('errors'=>$v->messages()->first()));
        }else{
            $source = SourceLibrary::domain()->whereId($id)->first();
            $source->fill($data);
            if($source->save()){
                return Redirect::route('sources.list');
            }else{
                return Redirect::back()->withInput()->withErrors(array('errors'=>"系统错误"));
            }
        }
    }

    //删除资源
    public function getDeleteSource($id){
        $source = SourceLibrary::domain()->whereId($id)->first();
        if($source && $source->delete()){
            return Redirect::route('sources.list');
        }else{
            return Redirect::route('sources.list')->withErrors(array('errors'=>"系统错误"));
        }
    }

    public function postAddPicture(){
        try{
            $image_file = Input::file('picture_file');
            Log::info($image_file);
            $content = '';
            $title = '';
            $image_id = 0;
            foreach($image_file as $key=>$file) {
                if ($file) {
                    $configure = array(
                        'attr' => 'image_id',
                        'folder' => 'SourceLibrary',
                        'relation_image_name' => 'image'
                    );
                    $image = $this->uploadImage($file, $configure, false, false, null);
                    if ($image) {
                        if($key == 0){
                            $title = substr($file->getClientOriginalName(),0, strrpos($file->getClientOriginalName(), '.'));
                            $image_id = $image->id;
                        }
                        $content =  $content.'<img src="'.AppHelper::imgSrc($image->url).'" image_id="'.$image->id.'"/>';
                    }
                }
            }
            $source = new SourceLibrary();
            $source->title = $title;
            $source->content = $content;
            $source->image_id = $image_id;
            $source->source_type = 1;
            $source->save();
            return Redirect::route('sources.list');
        }catch (Exception $e){
            return Redirect::route('sources.list')->withErrors(array('errors'=>"系统错误"));
        }

    }

//    public function postAddPicture(){
//        $image_file = Input::file('image');
//        if($image_file){
//            $configure = array(
//                'attr'=>'image_id',
//                'folder'=>'SourceLibrary',
//                'relation_image_name'=>'image'
//            );
//            try{
//                $image = $this->uploadImage($image_file,$configure,false,false,null);
//                if($image){
//                    $source = new SourceLibrary();
//                    $source->title = substr($image_file->getClientOriginalName(),0, strrpos($image_file->getClientOriginalName(), '.'));
//                    $source->image_id = $image->id;
//                    $source->source_type = 1;
//                    if($source->save()){
//                        return $this->setJsonMsg(1,$image->url);
//                    }
//                }
//            }catch (Exception $e){
//                return $this->setJsonMsg(0,'系统错误!');
//            }
//        }else{
//            return $this->setJsonMsg(0,'操作错误!');
//        }
//    }
} 
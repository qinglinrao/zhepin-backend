jQuery(document).ready(function($) {

    //素材添加类型显示/隐藏
    $('.source-list li.add-li .li-text').mouseover(function(){
        $(this).hide();
        $('.source-list li.add-li .add-link').show();
    })
    $('.source-list li.add-li .add-link').mouseout(function(){
        $(this).hide();
        $('.source-list li.add-li .li-text').show();
    })

    //素材封面上传
    $('#source-image').fileupload({
        url: mcmore.site_url+'/ajax/photo-upload',
        dataType: 'json',
        formData: {},
        done: function (e, data) {
            var $data = data.result;
            console.info($data)
            $('#source-image').prev('button').html('已上传');
            $('#source-image').next('input[type=hidden]').val($data.id);

        },
        progressall: function (e, data) {//设置上传进度事件的回调函数
            var progress = parseInt(data.loaded / data.total * 5, 10);
            $('#source-image').prev('button').html('上传中,已完成'+progress + '%');
        }
    });

    //素材列表 编辑、删除 链接显示/隐藏
    $('.source-list li.source').hover(function(){
        $(this).find('a.edit,a.delete').show();
    },function(){
        $(this).find('a.edit,a.delete').hide();
    })

    //删除素材图片
    $(document).on('click','.preview-image button.delete',function(){
        $(this).closest('.preview-image').remove();
        $('input#source_content').val('');
        $value = '';
        $('.preview-image img').each(function(){
            $value += '<img src="'+$(this).attr("src")+'" image_id="'+$(this).attr("image_id")+'" />';
        })
        $('input#source_content').val($value)
    })

    //素材图片hover 出现/隐藏删除按钮
    $('.preview-image').hover(function(){
        $(this).find('button.delete').show()
    },function(){
        $(this).find('button.delete').hide()
    })

    //商家上传头像
    $('input[type=file].merchant_face_image').fileupload({
        autoUpload: true,//是否自动上传
        url: '/merchant/upload_image',//上传地址
        dataType: 'json',
        done: function (e, data) {//设置文件上传完毕事件的回调函数
            console.info(data)
            var result = data.result;
            if (result.state == 1) {
                $('input[type=file].merchant_face_image').prev('img').attr('src', result.msg);
            } else {
                alert(result.msg);
            }

        }
    });

    $('header li.merchant_image').hover(function () {
        $(this).find('ul.son-menus').show()
    },function(){
        $(this).find('ul.son-menus').hide()
    })


    var $container = $('.source-list ul');
    $container.imagesLoaded( function(){
        $container.masonry({
            itemSelector : 'li',
            gutterWidth : 20,
            isAnimated: true
        });
    });

});

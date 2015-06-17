define(['jquery','application','/marionette/bower_components/jquery.form.js'],function($,mcMoreApp){



    $('#industry-list').on('change',function(){
        updateThemeList()
    });
    if($('#industry-list').length > 0){
        updateThemeList();
    }

    function updateThemeList(){
        var industry = $('#industry-list').val()
        $('#theme-list option.list').each(function(){
            var _industry = $(this).data('industry');
            if(_industry != industry ){
                $(this).hide().attr('disabled',true)
            }else{
                $(this).show().removeAttr('disabled')
            }
        });
        $('body').removeAttr('class')
        $('#theme-list option').removeAttr('selected').eq(0).attr('selected','selected')

    }

    $('#theme-list').on('change',function(){
        var theme = $(this).val();
        $('body').removeAttr('class').addClass(theme)
    });




    //save template

    $('#save-template').click(function(){
        var elements = getElements();
        var sort_order = mcMoreApp.sortResult.sortable("serialize",{key:'sort'});
        var page_options = {};
        page_options['id'] = $('#page-id').val();
        page_options['theme'] = $('#theme-list').val();
        page_options['name'] = $('#template-name').val();

        $('#image-upload').ajaxSubmit({
            success:function(result){
                if(result.state == 1){
                    $.ajax({
                        url: '/templates',
                        type: 'post',
                        data: {elements:elements,sort:sort_order,thumb:result.url,page_options:page_options},
                        dataType: 'json',
                        success:function(result){
                            alert(result.msg)
                        }
                    })
                }else{
                    alert(result.msg)
                }
            }
        });

    });


    function getElements(){
        var models = mcMoreApp.collections.pageElementList.models;
        var elements = {};
        for (i in models){
            elements[models[i].cid] = models[i].attributes
        }

        return elements;
    }


    $('.theme-item').on('click',function(){
        $('.theme-item').removeClass('active');
        $(this).addClass('active');
        var theme = $(this).data('code');
        var id = $(this).data('id');

        McMore.current_page.theme = theme;

        $('.theme-label').text($(this).text());
        $('body').removeAttr('class').addClass(theme);

        $('.template-item').each(function(){
            if($(this).data('theme') != id){
                $(this).addClass('hide');
            }else{
                $(this).removeClass('hide');
            }
        })
    })

    //=== select template ====

    $('.template-item').on('click',function(){
        var tid = $(this).data('id');
        $.ajax({
            url:'/templates/'+tid+'/config',
            type: 'get',
            dataType: 'json',
            success:function(result){
                $('.component-config-wrapper').slideUp(300)
                mcMoreApp.resetPreviewView(result);
            }
        })
    });


    // ========== save pages =================
    $('body').on('click',function(){
        $('.qrcode-wrapper').fadeOut();
    });

    $('#save-preview').click(function(){
        var elements = getElements();
        var sort_order = mcMoreApp.sortResult.sortable("serialize",{key:'sort'});
        var page_options = McMore.current_page;

        $.ajax({
            url: '/pages/'+page_options.id,
            type: 'post',
            data: {elements:elements,sort:sort_order,page_options:page_options},
            dataType: 'json',
            success:function(result){
                if(result.state == 1){
                    $('.qrcode-wrapper').fadeIn();
                }else{
                    $('.qrcode-wrapper').fadeOut();
                    alert(result.msg)
                }
            }
        })
    })


    $('#publish-site').click(function(){
        var site_id = McMore.current_page.site_id;
        $.ajax({
            url: '/pages/publish',
            data:{site_id:site_id},
            dataType: 'json',
            type: 'post',
            success:function(result){
                alert(result.msg)
            }
        })
    })

});


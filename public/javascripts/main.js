jQuery(document).ready(function($) {
    $('.editor').ckeditor({
        height: 300,
        filebrowserUploadUrl: '/ajax/editor-photo-upload'
    });

    $('.datetimepicker').datetimepicker({
        lang:'ch',
        format:'Y-m-d H:i'
    })

    $('#multiple-photo-upload').fileupload({
        url: '/ajax/photo-upload',
        dataType: 'json',
        formData: {},
        done: function (e, data) {
            var $data = data.result;

            $('#photo-warp').append('<div class="item">\
                <a class="corner" href="#"> &times;</a>\
                <img src=" '+$data.url+'" width="50px" height="50px">\
                <input name="images[]" type="hidden" value="'+$data.id+'">\
            </div>');
        },
        progressall: function (e, data) {//设置上传进度事件的回调函数
            var progress = parseInt(data.loaded / data.total * 5, 10);
            //$('#progress .bar').css(
            //    'width',
            //    progress + '%'
            //);
            console.info(progress)
        }
    });

    $('#photo-warp').on('click', '.corner', function(e) {
        e.preventDefault();
        $(this).closest('.item').remove();
    });

    $('#add-option').on('click', function() {
        var $template = '<tr>\
            <td><input class="form-control" name="new_values[name][]" type="text" value="">\
            </td>\
            <td><a href="javascript:void(0)" class="destroy-option">移除</a></td>\
        </tr>';

        $('#option-values').find('tbody').append($template);
    });

    $('#option-values').on('click', '.destroy-option', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    });

    $('.destroy').on('click', function(e) {
        e.preventDefault();

        if(confirm('确定要删除记录！')) {
            $.ajax({
                url: $(this).attr('href'),
                dataType: "json",
                method: 'POST',
                data: {_method:'DELETE'},
                success: function(){
                    location.reload();
                }
            });
        }
    });

    // 更多筛选条件
    $('.search span.more-filter').on('click', function(e) {
        e.preventDefault();
        $(this).closest('.search-top').next('.search-bottom').toggle();
    });

    //input 日期选择
    $('.form_date').datetimepicker({
        lang:'ch',
        format:'Y-m-d',
        timepicker:false
    });

    // 添加选中的checkbox值到ids数组中，并赋值给 ids_input输入框
    function addSonCheckboxIdsToArray(obj,ids_input){
        var ids = [];
        obj.each(function(){
            if($(this).is(':checked')){
                ids.push($(this).val());
            }
        })
        ids_input.val(ids.toString());
    }

    var son_checkboxs = $('.son_checkbox');
    //数据列表checkbox选中
    son_checkboxs.click(function(){
        addSonCheckboxIdsToArray(son_checkboxs,$('#son_checkbox_ids'));
    });

    //数据列表 全选/取消全部
    $('input.all-checkbox').click(function(){
        if($(this).is(':checked')){
            $('.son_checkbox').prop("checked","checked");
            $('input.all-choose').prop("checked","checked");
            addSonCheckboxIdsToArray(son_checkboxs,$('#son_checkbox_ids'));
        }else{
            son_checkboxs.removeAttr("checked");
            $('input.all-choose').removeAttr("checked");
            $('#son_checkbox_ids').val('');
        }
    })

    //会员添加到分组 下拉列表
    $('select.add_to_group_select').change(function(){
        var ids = $.trim($('#son_checkbox_ids').val());
        var group_id = $.trim($(this).val());
        if(ids != "" ){
            if(group_id != "" && parseInt(group_id) > 0){
                $.ajax({
                    url: $(this).attr('url'),
                    dataType: "json",
                    method: 'POST',
                    data: {ids:ids,group_id:group_id},
                    success: function(data){
                        console.info(data)
                        if(data.result == 1){
                            location.reload();
                        }else{
                            alert('系统错误!');
                        }

                    }
                });
            }else{
                alert('请选择添加的组!');
            }
        }else{
            alert('请选择要操作的记录!');
        }

    })

    //省份选择下拉列表
    $('select#province_select').change(function(){
        var province_id = $.trim($(this).val());
        if(province_id != "" && parseInt(province_id) > 0){
            $('select#city_select').html("");
            $.ajax({
                url: '/ajax/get-citys',
                dataType: "json",
                method: 'POST',
                data: {province_id:province_id},
                success: function(data){
                    if(data.length > 0){
                        $('select#city_select').append('<option value="">--请选择市--</option>');
                        $.each(data, function(i) {
                            $('select#city_select').append("<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>");
                        });

                    }else{
                        $('select#city_select').append('<option value="">--无下级市--</option>');
                    }
                }
            });
        }
    });


    $('button#to-add-profit').click(function(){
        var tr = $('<tr>' +
            '<td ><input type="text" class="txt-input name-input"></td>' +
            '<td><input type="" value="0" class="num-input first-input" >%</td>' +
            '<td><input type="" value="0" class="num-input two-input" >%</td> ' +
            '<td><input type="" value="0" class="num-input three-input" >%</td>' +
            '<td>0</td>' +
            '<td></td></tr>');
        var button = $('<button class="button button-primary button-small ">保存</button>');
        tr.find('td:last-child').append(button);
        $(this).prev('table').find('tbody').append(tr);

        button.click(function(){
            var tr = $(this).closest('tr');
            var name = $.trim(tr.find('input.name-input').val());
            var first = $.trim(tr.find('input.first-input').val());
            var two = $.trim(tr.find('input.two-input').val());
            var three = $.trim(tr.find('input.three-input').val());

            if(name == null || name == ""){
                alert('请填写名称！');
                return false;
            }else if(!judge_profit_num(first) || !judge_profit_num(two) || !judge_profit_num(three)){
                alert('分润值必须为0~100之间的整数值');
                return false;
            }else{
                $.ajax({
                    url: '/ajax/create-profit',
                    dataType: "json",
                    method: 'POST',
                    data: {id:'',name:name,first:first,two:two,three:three},
                    success: function(data){
                        console.info(data)
                        if(data.state == 1){
                           location.reload();
                        }else{
                            alert(data.msg);
                        }
                    }
                });
            }
            return false;
        })
    });

    function judge_profit_num(value){
        var int_val = parseInt(value);
        var int_reg = /^[0-9]+$/;
        if(int_reg.test(value) && int_val >=0 && int_val <= 100){
            return true;
        }
        return false;
    }

    $('button#update-profit').click(function(){
        var tr = $(this).closest('tr');
        var id = $.trim(tr.find('input.id-input').val());
        var name = $.trim(tr.find('input.name-input').val());
        var ba = $.trim(tr.find('input.ba-input').val());
        var store = $.trim(tr.find('input.store-input').val());
        var agent = $.trim(tr.find('input.agent-input').val());

        if(name == null || name == ""){
            alert('请填写名称！');
            return false;
        }else if(!judge_profit_num(ba) || !judge_profit_num(store) || !judge_profit_num(agent)){
            alert('分润值必须为0~100之间的整数值');
            return false;
        }else{
            $.ajax({
                url: '/ajax/create-profit',
                dataType: "json",
                method: 'POST',
                data: {id:id,name:name,ba:ba,store:store,agent:agent},
                success: function(data){
                    console.info(data)
                    if(data.state == 1){
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                }
            });
        }
        return false;
    })


    $('.merchants .table-sort e').click(function(){
        var b = $(this).closest('.table-sort');
        var query = $('input#query').val();
        var sort_name = b.attr('data-name')
        if($(this).hasClass('asc')){
            var href = location.pathname+'?query='+query+'&sort_name='+sort_name+'&sort_val=asc';
            location.href = href;
        }else{
            var href = location.pathname+'?query='+query+'&sort_name='+sort_name+'&sort_val=desc';
            location.href = href;
        }
    });

    $('.merchants-detail .table-sort e').click(function(){
        var b = $(this).closest('.table-sort');
        var query = $('input#query').val();
        var sort_name = b.attr('data-name');
        var sc = getUrlParam('sc')==null?0: getUrlParam('sc');
        if($(this).hasClass('asc')){
            var href = location.pathname+'?sc='+sc+'&from='+getUrlParam('from')+'&sort_name='+sort_name+'&sort_val=asc';
            location.href = href;
        }else{
            var href = location.pathname+'?sc='+sc+'&from='+getUrlParam('from')+'&sort_name='+sort_name+'&sort_val=desc';
            location.href = href;
        }
    });

    //批量删除商家
    $('button#batch_del_merchant').click(function(){
        var ids = $.trim($('#son_checkbox_ids').val());
        if(ids != "" ){
            if(window.confirm('您确定要删除这些商家记录,删除后不可恢复!')) {
                $.ajax({
                    url: $(this).attr('url'),
                    dataType: "json",
                    method: 'POST',
                    data: {ids: ids},
                    success: function (data) {
                        if (data.result == 1) {
                            location.reload();
                        } else {
                            alert('系统错误!');
                        }
                    }
                });
            }
        }else{
            alert('请选择要操作的记录!');
        }

    })

    //批量删除顾客
    $('button#batch_del_customer').click(function(){
        var ids = $.trim($('#son_checkbox_ids').val());
        if(ids != "" ){
            if(window.confirm('您确定要删除这些顾客记录,删除后不可恢复!')){
                $.ajax({
                    url: $(this).attr('url'),
                    dataType: "json",
                    method: 'POST',
                    data: {ids:ids},
                    success: function(data){
                        if(data.result == 1){
                            location.reload();
                        }else{
                            alert('系统错误!');
                        }
                    }
                });
            }

        }else{
            alert('请选择要操作的顾客记录!');
        }
    })

    //获取地址query参数
    function getUrlParam(name)
    {
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r!=null) return unescape(r[2]); return null; //返回参数值
    }

    //开启证件审核弹窗
    $('a.open_id_card_check').click(function(){
        $('.id_card_check iframe').attr('src','/merchants/account_idcard_check?id='+$(this).attr('data-val'));
        $('.id_card_check').show();
    })

    //关闭证件审核弹窗
    $('button.close_btn').click(function(){
        $(this).closest('.window').hide();
    })

    $('.drop-down b').click(function(){
        $(this).next('ul').toggle();
    })

    //分润配置选择
    $('.profit_rules span').click(function(){
        $(this).closest('.profit_rules').find('input.profit_id').val($(this).attr('profit_id'));
        var table = $(this).closest('.profit_rules').next('table.profit_val');
        console.info($(this).attr('first_profit'))
        table.find('input.first_profit').val($(this).attr('first'));
        table.find('input.two_profit').val($(this).attr('two'));
        table.find('input.three_profit').val($(this).attr('three'));
        $('.profit_rules span.cur').removeClass('cur');
        $(this).addClass('cur');
    })

    $('.choose_product_type input[name=display_type]').click(function(){
        var table = $('table.profit_val');
        if($(this).val() == 1){
            $('.profit_rules').hide().find('input.profit_id').val(0);
            $('.profit_rules span.cur').removeClass('cur');
            table.find('input.first_profit').val(10);
            table.find('input.two_profit').val(0);
            table.find('input.three_profit').val(0);
            table.find('tr').hide();
            console.info(table.find('tr'));
            table.find('tr:first').show().find('td:first').html('美肤专家');
        }else{
            $('.profit_rules').show();
            table.find('tr').show();
            table.find('tr:first td:first').html('第一级');
        }
    })


    $('#photo-warp img').imageZoom({});


    $('select#rootCategorySelect').change(function(){
        var root_category_id = $(this).children('option:selected').val();
        $.ajax({
            url: '/ajax/get-second-category',
            dataType: "json",
            method: 'POST',
            data: {root_category_id:root_category_id},
            success: function(data){
                $('select#secondCategorySelect').html('');
                $('select#secondCategorySelect').append('<option value="0">二级分类</option>');
                $.each(data,function(i,category){
                    $('select#secondCategorySelect').append('<option value="'+category['id']+'">'+category['name']+'</option>');
                });
                $('input#category_id').val(root_category_id);
            }
        });
    })

    $('select#secondCategorySelect').change(function(){
        var root_category_id = $(this).children('option:selected').val();
        $('input#category_id').val(root_category_id);
    })


    //商品批量上下架
    $('button.change_product_status').click(function(){
        var ids = $.trim($('#son_checkbox_ids').val());
        var status = $(this).attr('status');
        if(ids != "" ){
            $.ajax({
                url: '/ajax/change-product-status',
                dataType: "json",
                method: 'POST',
                data: {ids:ids,status:status},
                success: function(data){
                    console.info(data)
                    if(data.result == 1){
                        location.reload();
                    }else{
                        alert('系统错误!');
                    }
                }
            });
        }else{
            alert('请选择要操作的记录!');
        }
        return false;

    })



    //商品分类图片上传
    $('input#upload_category_image').fileupload({
        url: '/ajax/upload-category-image',
        dataType: 'json',
        formData: {"category_id":$('input#upload_category_image').attr('category_id')},
        done: function (e, data) {
            var result = data.result;
            console.info(result);
            if(result.state == 1){
                $img = $('<img src="'+result.msg+'" width="140" />');
                $('.category_image_priview').html($img);
                $img.imageZoom({});
            }else{
                alert(result.msg);
            }
        },
        progressall: function (e, data) {//设置上传进度事件的回调函数
            var progress = parseInt(data.loaded / data.total * 5, 10);
            //$('#progress .bar').css(
            //    'width',
            //    progress + '%'
            //);
            console.info(progress)
        }
    });

    $(' img.categroy-image').imageZoom({});


    autoHideFormTip(3500);
    function autoHideFormTip($time){
        $form_tip = $('p.form-tip');
        if($.trim($form_tip.html()) != "") $form_tip.show();
        $form_tip.css({'margin-left':(-1*$form_tip.width()/2)+'px'});
        if($form_tip != null){
            if($.trim($form_tip.html()) != ""){
                setTimeout(function(){
                    $form_tip.fadeOut(1500);
                },$time);
            }else{
                $form_tip.hide();
            }

        }
    }


    $('#deliver-action form').submit(function(){
        return confirm('确定填写无误？提交后将不可修改！');
    })

    $(' img.banner_image').imageZoom({});


    var wap_site = 'http://192.168.0.39:8087';

    $('input.banner_input').on('input',function(){
        var value = $.trim($(this).val());
        var banner_input = $(this);
        $('ul.products-list').remove();
        console.info(value)
        if(value != ""){
            console.info(value);
            $.ajax({
                url: '/ajax/search-product',
                dataType: "json",
                method: 'POST',
                data: {"query":value},
                success: function(data){
                   if(data.length > 0){
                       $ul = $('<ul class="products-list"></ul>');
                       $.each(data,function(i,item){
                           $ul.append($('<li url="'+wap_site+'/products/'+item.id+'" title="'+item.name+'">'+subString(item.name,50,true)+'</li>'));
                       });
                       banner_input.after($ul);
                       $ul.find('li').click(function(){
                           banner_input.val($(this).attr('url'));
                           $ul.remove();
                       });
                   }

                }
            });
        }
    });


    //截取中文字符串
    //截取字符串 包含中文处理
//(串,长度,增加...)
    function subString(str, len, hasDot)
    {
        var newLength = 0;
        var newStr = "";
        var chineseRegex = /[^\x00-\xff]/g;
        var singleChar = "";
        var strLength = str.replace(chineseRegex,"**").length;
        for(var i = 0;i < strLength;i++)
        {
            singleChar = str.charAt(i).toString();
            if(singleChar.match(chineseRegex) != null)
            {
                newLength += 2;
            }
            else
            {
                newLength++;
            }
            if(newLength > len)
            {
                break;
            }
            newStr += singleChar;
        }

        if(hasDot && strLength > len)
        {
            newStr += "...";
        }
        return newStr;
    }



});
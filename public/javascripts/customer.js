jQuery(document).ready(function($) {

    // 使用默认参数


    function equal_to_validate(source,target){
        var source_val = $.trim(source.val());
        var target_val = $.trim(target.val());
        if(target_val != source_val){
            form_alert_show(source,'两次输入的密码不相符')
            return false;
        }else{
            form_alert_hide(source);
            return true;
        }

    }

    function form_alert_show(obj,info){
        $form_alert = obj.closest('form').find('.am-alert-secondary');
        $form_alert.find('p').html(info);
        $form_alert.show()
        obj.closest('.am-input-group ').addClass('am-form-error');
    }

    function form_alert_hide(obj){
        $form_alert = obj.closest('form').find('.am-alert-secondary');
        $form_alert.find('p').html('');
        $form_alert.hide()
        obj.closest('.am-input-group ').removeClass('am-form-error');
    }

    function phone_validate(obj){
        var phone = obj.val();
        if(phone.length != 11 || !mobile.test(phone)){
            form_alert_show(obj,'请输入正确的手机号');
            return false;
        }else{
            form_alert_hide(obj);
        }
        return true;
    }

    function not_empty_validate(obj,target_name){
        console.info(target_name)
        var val = $.trim(obj.val());
        if(val == null || val == ""){
            form_alert_show(obj,'请填写'+target_name)
            return false;
        }else{
            form_alert_hide(obj);
            return true;
        }
    }

    function select_validate(obj,target_name){
        var val = $.trim(obj.val());
        if(val == null || val == ""){
            form_alert_show(obj,'请选择'+target_name)
            return false;
        }else{
            form_alert_hide(obj);
            return true;
        }
    }

    var mobile = /^(((1(3|4|5|7|8)[0-9]{1}))+\d{8})$/
    $('.register-wrapper form').submit(function(){
        if(!not_empty_validate($('#phone-input'),'手机号') || !not_empty_validate($('#code-input'),'验证码') || !not_empty_validate($('#pwd-input'),'密码') || !not_empty_validate($('#repwd-input'),'确认密码')){
            return false;
        }else if ( !phone_validate($('#phone-input')) || !equal_to_validate($('#repwd-input'),$('#pwd-input'))){
            return false;
        }else if(!select_validate('#industry_select','行业')){
            return false;
        }
        return true;

    })

    var timeLeft = 60;
    $('button.get-code').click(function(){
        var phone  = $.trim($('#phone-input').val());
        if(!phone_validate($('#phone-input'))){
            return false;
        }else{
            var $self = $(this)
            $self.addClass('am-disabled');
            $.ajax({
                url: '/authcode',
                data:{'mobile':phone},
                dataType: 'json',
                type: 'post',
                beforeSend:function(){
                    $self.text('发送中...')
                },
                success: function(result){
                    console.info(result);
                    if(result.state == 1){
                        var countDown = setInterval(function(){
                            timeLeft--;
                            if(timeLeft == 0){
                                clearInterval(countDown)
                                $self.text('获取验证码')
                                $self.removeClass('got')
                            }else{
                                $self.text('('+timeLeft+')重新获取')
                                $self.removeClass('am-disabled');
                            }
                        },1000)
                    }else{
                        alert('系统出错')
                        $self.removeClass('am-disabled');
                    }
                },
                error: function(){
                    $self.removeClass('am-disabled');
                }
            })
        }
        return false;
    })




    $('.am-alert button.am-close').click(function(){
        $(this).closest('.am-alert').hide();
    })




    $('.login-wrapper form').submit(function(){
        var tip = $(this).find('span.form-tip');
        if(!empty_validate($('#phone-input'),tip,'手机号') ||  !empty_validate($('#pwd-input'),tip,'密码')  || !empty_validate($('#code-input'),tip,'验证码') || !mobile_validate($('#phone-input'),tip) ){
            return false;
        }
        return true;

    })



    /**
     * 非空验证
     * @param obj
     * @param tip
     * @param name
     */
    function empty_validate(obj,tip,name){
        var val = $.trim(obj.val());
        if(val == null || val == ""){
           return error_deal(obj,tip,'请输入'+name);
        }else{
           return success_deal(obj,tip,'');
        }
    }

    /**
     * 错误处理
     * @param obj
     * @param tip
     * @param val
     * @returns {boolean}
     */
    function success_deal(obj,tip,val){
        obj.removeClass('error').addClass('success');
        tip.html(val);
        return true;
    }

    /**
     * 成功处理
     * @param obj
     * @param tip
     * @param val
     * @returns {boolean}
     */
    function error_deal(obj,tip,val){
        obj.removeClass('success').addClass('error');
        tip.html(val);
        return false;
    }

    function mobile_validate(obj,tip){
        var mobile = /^(((1(3|4|5|7|8)[0-9]{1}))+\d{8})$/
        var val = $.trim(obj.val());
        if(val.length != 11 || !mobile.test(val)){
            return error_deal(obj,tip,'请输入正确的手机号码')
        }else{
            return success_deal(obj,tip,'');
        }
    }





})

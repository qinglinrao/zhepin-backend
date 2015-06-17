(function($){

    $(window).on('orientationchange',function(e){
        var width = window.innerWidth * window.scale;
        var scale, content;
        scale = width/320;
        content = "width=320px,initial-scale="+scale+",minimum-scale=0.1,user-scalable=no";

        $('meta[name=viewport]').attr('content',content);

        if(scale != parseFloat(window.scale)){
            window.scale = scale;
            $.get('/set-scale?homeScale='+scale)
        }

    });

    $(window).trigger('orientationchange')

    $('.component-slideshow').each(function(){
        var $self = $(this);
        var rtl = $self.data('rtl') == 0;
        var time = $self.data('time');
        if($("#slideshow .slide",$self).length < 2) return;

        $("#slideshow",$self).owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            rtl: rtl,
            autoplayTimeout: time
        });
    });


    $('.iscroll-wrapper').each(function(i,el){
        var width = 0;
        var $self = $(this);
        $('.nav-item',$self).each(function(){
            width += $(this).outerWidth();
        });

        $('.scroll-content',$self).width(width);

        var iS = new IScroll(el, {eventPassthrough: true, scrollX: true, scrollY: false, preventDefault: false });

        if(iS.maxScrollX < 0){
            $('.more-right',$self).show()
        }

        iS.on('scrollEnd', function () {
            if(this.x <= -5){
                $('.more-left',$self).show()
            }else{
                $('.more-left',$self).hide()
            }

            if(this.x >= this.maxScrollX + 5){
                $('.more-right',$self).show()
            }else{
                $('.more-right',$self).hide()
            }
        });
    })



})(jQuery)
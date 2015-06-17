

$(document).ready(function(){
  
jQuery.jqtab = function(tabtit,tab_conbox,shijian) {
	
	$(tab_conbox).find(".menu-item").hide();
	$(tabtit).find("li:first").addClass("current").show(); 
	$(".menu-item").eq(0).show();

	$(tabtit).find("li").bind(shijian,function(e){
        e.preventDefault();
        $(this).addClass("current").siblings("li").removeClass("current"); 
        var activeindex = $(tabtit).find("li").index(this);
        $(".menu-item").eq(activeindex).stop().show().siblings().hide();	
	});
};

$.jqtab("#tabs","#tab_conbox","click");

//var _Filter = $("#right-main").contents().find(".more-filter");

var _Filter = $(".more-filter");
    
    _Filter.on('click', function (e){
        
        e.preventDefault();			
        $(".search").toggleClass('search-open');
        
    });
     
    $('.check').on('click', function (){
        $(this).toggleClass('current');    
    });
    
    
    
});   
    
    
    
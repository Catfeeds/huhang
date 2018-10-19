
/*====================================页面配置====================================*/
$(function(){
	var sWidth=document.documentElement.scrollWidth;
	var sHieght=document.documentElement.scrollHeight;
	var in_height=document.body.offsetHeight;
	$("#banner").width(sWidth) ;
	 
	 $("#banner").slide({titCell:".hd ul",mainCell:".bd ul",effect:"leftLoop",delayTime:800,titOnClassName:"current",autoPage:true,autoPage:'<li><a href="javascript:void(0)"> </a></li>'});
	//TouchSlide({ slideCell:"#banner",mainCell:".bd ul ",effect:"leftLoop",autoPlay:true,delayTime:800,interTime:6000});
	$("#nav").slide({titCell:".title",targetCell:".list",type:"menu",effect:"slideDown",delayTime:200,triggerTime:210,returnDefault:false,titOnClassName:"on_on"});
	$("#s_team").slide({mainCell:".bd ul",effect:"leftLoop",vis:1,delayTime:800,trigger:"click"});
	$("#s_news").slide({mainCell:".bd ul",effect:"leftLoop",vis:3,delayTime:800,trigger:"click"}); 
	
	$("#bnt_close,#bnt_show_video").click(function(){
		$("#show_video_box").fadeToggle(300);
		}
	);
	$("#nav_case").slide({mainCell:".bd ul",effect:"leftLoop",scroll:1,vis:5,delayTime:800,trigger:"click"});
		 
	$("#list_slide dt").click(function(){

		 if ($(this).hasClass('on')) {
			$(this).next().slideUp(); //合上

			$(this).removeClass("on"); 

		}else{

			$("#list_slide dt").removeClass("on");

			$("#list_slide dd").slideUp();

			$(this).addClass("on"); 

			$(this).next().slideDown();		

		}

	 

	});
	 
})

   window.onscroll=function(){
 if($(window).scrollTop()>620){
	 
	 $("#gotop_box").slideDown();
	 }
	  else if($(window).scrollTop()<620){
	 $("#gotop_box").slideUp();
	 }
 };


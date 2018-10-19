
   
    $('.nav-icon').click(function(){
        
        $('.nav-ul-index').addClass('menuin');
        $('.nav-ul-index li').css('z-index','10002')
    })
    $('.nav-ul-index i,.nav-ul-index').click(function(){
        
        $('.nav-ul-index').removeClass('menuin').addClass('menuout');
        setTimeout(function(){
            $('.nav-ul-index').removeClass('menuout'); 
        },200) 
    })

    // 城市功能
    $(".head-city").click(function(){
        $(this).siblings(".city-list").slideToggle(500);
    })

    // $(".citys").click(function(){
    //      var city = $(this).children("a").text();
    //      $(this).parents(".city-list").siblings(".head-city").children("a").text(city);
    //      $(this).parents(".city-list").slideUp(500);
    // })
    
    
    var number_time=0
    function rangeRandom(minnum, maxnum) {
            return Math.floor(minnum + Math.random() * (maxnum - minnum + 1));
    }

    function changeNum(time) {
        var zbj,i;
        number_time = setInterval(function() {
            zbj = rangeRandom(10000, 200000) + '';
            // 换数字之前先全隐藏
            $('.num-window div').hide().find('img').hide();
            // 遍历数字,个位在length-1处
            var strl = zbj.length - 1;
            for (i = strl; i >= 0; i--) {
                // 遍历显示数字
                $('.num-window div').eq(strl - i).find('img').eq(zbj[i]).show().end().end().show();
            }
        }, time);
    }
    changeNum(200);

    // 底部优惠券效果
    $(".sjbtn").click(function(){
        $(this).parent(".ticket").siblings(".sj-quan").show();
    })
    $(".lfbtn").click(function(){
        $(this).parent(".ticket").siblings(".lf-quan").show();
    })
    $(".close").click(function(){
        $(this).parents(".quan-form").hide();
    })

    // 滴滴接驾预约表单
    $(".xabtn").click(function(){
        $(this).parents(".xanav").siblings(".xa-form").show();
    })
    $(".kmbtn").click(function(){
        $(this).parents(".kmnav").siblings(".km-form").show();
    })
    $(".whbtn").click(function(){
        $(this).parents(".whnav").siblings(".wh-form").show();
    })
    $(".bjbtn").click(function(){
        $(this).parents(".bjnav").siblings(".bj-form").show();
    })




    function tab(li,div){
        $(li).click(function(){
            var $li = $(this).index();
            $(this).addClass('cur').siblings().removeClass('cur');
            $(div).eq($li).show().siblings().hide();
        })
    }
    tab('.zhengz-pro #list-index li','.zhengz-pro .div-all .img1');


$(function(){
	$('input').on('focus',function( ){
		$('.quote-price').css({'position':'static'})
		});
		$('input').on('blur',function( ){
			$('.quote-price').css({'position':'fixed'})
		});
})
	




















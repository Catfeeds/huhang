$(function () {
    var swiper = new Swiper('.swiper-container', {
        direction: 'vertical',
        slidesPerView: 9,
        spaceBetween: 10,
        // mousewheel: true,
        loop: true,
        autoplay: {
            delay: 500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    // 表单验证效果
    $('.send-btn').click(function () {
        var sendArea = $(".send-area").val();
        var sendName = $(".send-name").val();
        var sendCont = $(".send-contact").val();
        if (sendArea.length > 4 || sendArea == "") {
            alert("请输入正确的房屋面积")
            return false;
        } else if (sendName == "") {
            alert("用户名不能为空")
            return false;
        } else if (sendCont.length !=11 || sendCont.substring(0,1)!=1 || sendCont == "") {
            alert("请输入有效的手机号码")
            return false;
        } else {
            return true;
        }
    })


    //返回顶部

    $(".return-top").click(function () {
        $("html,body").animate({
            "scrollTop": "0"
        }, 500)
    })

    // 弹出层
    var warp = $(".form-wrap");
    $(".sidebar li ").click(function () {
        var i = $(this).data('layer');
        console.log(i);
        if (i == "yuyue") {
            $(".form-text").text("预约设计");
            $(".form-p").text("金牌设计师一对一服务  为您打造会呼吸的家");
            warp.css({   
                "transform": "scale(1)",
                "-ms-transform": "scale(1)",
                "-webkit-transform": "scale(1)"
            })
        } else if (i == "mianfei") {
            $(".form-text").text("免费报价");
            $(".form-p").text("要装修先报价 超详细预算清单发送到您的手机");
            warp.css({
                "transform": "scale(1)",
                "-ms-transform": "scale(1)",
                "-webkit-transform": "scale(1)"
            })
        }

    })
    $(".closebtn").click(function () {
        warp.css({
            "transform": "scale(0)",
            "-ms-transform": "scale(0)",
            "-webkit-transform": "scale(0)"
        });
    })
})
   // 表单验证效果
    $('.send-btn1').click(function () {
    var sendName = $(".send-name1").val();
    var sendCont = $(".send-contact1").val();
    if (sendName == "") {
        alert("用户名不能为空")
        return false;
    } else if (sendCont.length !=11 || sendCont.substring(0,1)!=1 || sendCont == "" ) {
        alert("请输入有效的手机号码")
        return false;
    } else {
        return true;
    }
})

// 千百炼活动
var warp = $(".form-wrap");
$(".qiang-kf").click(function(){
    warp.css({
        "transform": "scale(1)",
        "-ms-transform": "scale(1)",
        "-webkit-transform": "scale(1)"
    });
    $(".form-text").text("新品发布会 畅享八重钜惠");
    $(".form-p").text("以千锤百炼的装修品质，打造会呼吸的家");
})

var wow = new WOW({    
    boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: false,
        live: true
});
wow.init();
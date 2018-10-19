$(function () {

    // 表单验证效果
    // $('.send-btn').click(function () {
    //     var sendArea = $(".send-area").val();
    //     var sendName = $(".send-name").val();
    //     var sendCont = $(".send-contact").val();
    //     if (sendArea.length > 4 || sendArea == "") {
    //         alert("请输入正确的房屋面积")
    //         return false;
    //     } else if (sendName == "") {
    //         alert("用户名不能为空")
    //         return false;
    //     } else if (sendCont.length != 11 || sendCont.substring(0, 1) != 1 || sendCont == " ") {
    //         alert("请输入有效的手机号码")
    //         return false;
    //     } else {
    //         return true;
    //     }
    // })

    // 计算器点击弹出
    $(".layer-jsq-btn").click(function () {
        $(".layer-jisuanqi").show();
    })
    // 计算器表单验证
    $(".jisuan-top-fr input").click(function () {
        var jisuanM = $(".jisuanji-mian").val();
        var jisuanN = $(".jisuan-name").val();
        var jisuanC = $(".jisuan-mycall").val();
        if (jisuanM == "" || jisuanM.length >= 5) {
            alert("请输入正确的房屋面积");
            return false;
        } else if (jisuanN == "") {
            alert("请输入您的姓名");
            return false;
        } else if (jisuanC == "" || jisuanC.substring(0, 1) != 1 || jisuanC.length !== 11) {
            alert("请正确输入您的手机号码");
            return false;
        }
    })

    $(".stage-if-btn").click(function () {
        var stageM = $(".stage-mianji").val();
        var stageN = $(".stage-name").val();
        var stageC = $(".stage-mycall").val();
        if (stageM == "" || stageM.length >= 5) {
            alert("请输入正确的房屋面积");
            return false;
        } else if (stageN == "") {
            alert("请输入您的姓名");
            return false;
        } else if (stageC == "" || stageC.substring(0, 1) != 1 || stageC.length !== 11) {
            alert("请正确输入您的手机号码");
            return false;
        }
    })
    $(".stage-btn-shou").click(function () {
        $(".layer-stage").show();
    })



    $(".foorer-btn").click(function(){
        var m = $(".footer-mianji").val();
        var n = $(".footer-name").val();
        var p = $(".footer-mycall").val();
        if (m == "" || m.length >= 5) {
            alert("请输入正确的房屋面积");
            return false;
        } else if (n == "") {
            alert("请输入您的姓名");
            return false;
        } else if (p == "" || p.substring(0, 1) != 1 || p.length !== 11) {
            alert("请正确输入您的手机号码");
            return false;
        }
    })

    //返回顶部
    // $(".return-top").click(function () {
    //     $("html,body").animate({
    //         "scrollTop": "0"
    //     }, 500)
    // })
})





var wow = new WOW({    
    boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: false,
        live: true
});
wow.init();


var intDiff = parseInt(300000); //倒计时总秒数量
function timer(intDiff) {
    window.setInterval(function () {
        var day = 0,
            hour = 0,
            minute = 0,
            second = 0; //时间默认值        
        if (intDiff > 0) {
            day = Math.floor(intDiff / (60 * 60 * 24));
            hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
            minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
            second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
        }
        if (minute <= 9) minute = '0' + minute;
        if (second <= 9) second = '0' + second;
        $('#day_show').html(day);
        $('#hour_show').html('<s id="h"></s>' + hour);
        $('#minute_show').html('<s></s>' + minute);
        $('#second_show').html('<s></s>' + second);
        intDiff--;
    }, 1000);
}




$(function () {
    timer(intDiff);
	
	
	
	$(".ban-button").click(function(){
		var m = $(".ban-mian").val();
		var n = $(".ban-name").val();
		var c = $(".ban-call").val();
		if (m == "" || m.length >= 5) {
			alert("请输入正确的房屋面积");
			return false;
		} else if (n == "") {
			alert("请输入您的姓名");
			return false;
		}else if (c == "" || c.length != 11 || c.substring(0, 1) != 1) {
			alert("请输入正确的手机号码");
			return false;
		}

	})
	
    // 弹出层
    $(".youhui-btn").click(function () {
        clearfix()
        var hText = $(".layer-com-h3");
        var pText = $(".layer-com-p");
        var thisAttr = $(this).attr("data-layer")
        var formTitle = $(".form-title");
        //alert(thisAttr);
        if (thisAttr == 0) {
            hText.text("立即预约");
            pText.html("今日还剩<em class='init-em'>5</em>个名额");
            formTitle.val("橙色报价页-装修特惠季-表单");
        } else if (thisAttr == 1) {
            hText.text("免费专车到店");
            pText.html("目前已接送<em class='init-em'>287401</em>人到店参观");
            formTitle.val("橙色报价页-专车免费送-表单");
        } else if (thisAttr == 2) {
            hText.text("精美案例 真实呈现");
            pText.html("已有<em class='init-em'>20300</em>2人查看案例");
            formTitle.val("橙色报价页-精美案例-表单");
        } else if (thisAttr == 3) {
            hText.text("装修免费报价");
            pText.html("预约家装新风尚 品质生活触手可得");
            formTitle.val("橙色报价页-精美案例-装修免费报价表单");
        } else if (thisAttr == 4) {
            hText.text("装修免费设计");
            pText.html("今日还剩<em class='init-em'>98</em>个名额");
            formTitle.val("橙色报价页-精美案例-装修免费报价表单");
        }
        $(".zhungxiutehui").fadeIn("slow");
    })

    // 正则函数
    $(".con-layer-btn").on("click", function () {
        var conMian = $(this).parents(".com-layer-form").children().children(".con-layer-mian").val();
        var conName = $(this).parents(".com-layer-form").children().children(".con-layer-name").val();
        var conMycall = $(this).parents(".com-layer-form").children().children(".con-layer-mycall").val();
        // alert(conMian, conName, conMycall);
        if (conMian == "" || conMian.length >= 5) {
            alert("请输入正确的房屋面积");
            return false;
        } else if (conName == "") {
            alert("请输入您的姓名");
            return false;
        } else if (conMycall == "" || conMycall.length != 11 || conMycall.substring(0, 1) != 1) {
            alert("请输入正确的手机号码");
            return false;
        }
    })

    // 清除文本域中的值
    function clearfix() {
        $(".con-layer-mian").val("");
        $(".con-layer-name").val("");
        $(".con-layer-mycall").val("")
    }


    // 关闭按钮
    $(".com-layer-esc img").click(function () {
        $(".layer-con-bg").fadeOut("slow");
    })
    // 装修测试
    $(".test-cent-radio label").click(function () {
        var $this = $(this).index();

        // console.log($this);
        $(this).addClass("labelhove");
        $(this).parents(".test-parents").siblings(".test-parents").children(".test-cent-radio").children(".outfit-label").removeClass("labelhove");

        // 切换图片
        $(this).parents(".test-cent-radio").siblings("em").children(".imgs").addClass("zinde").parents("em").parents(".test-parents").siblings().children("em").children(".imgs").removeClass("zinde");

        // 添加选中状态
        $(this).siblings("input").attr("checked", true).parents(".test-parents").siblings().children(".test-cent-radio").children("input").attr("checked", false);
    })
    // 装修测试按钮
    // 下一个
    $(".test-btn-next1").click(function () {
        var inp1 = $("input[name='one']:checked").length;
        if(inp1 == 0){
             alert("请选择您的户型");
             return false;
         } else{
		    var i = $(this).parents(".test-style-cent").index() + 1;
			$(".test-style-box .test-style-cent").eq(i).addClass("box-this").siblings().removeClass("box-this");
		}
    })
	
	 $(".test-btn-next2").click(function () {
		var inps = $("input[name='six']:checked").length;
		var inp2 = $("input[name='two']:checked").length;
        if(inps == 0 || inp2==0){
             alert("请选择您的性别年龄");
             return false;
         } else{
		    var i = $(this).parents(".test-style-cent").index() + 1;
			$(".test-style-box .test-style-cent").eq(i).addClass("box-this").siblings().removeClass("box-this");
		}
    })
	
	 $(".test-btn-next3").click(function () {
		var inp3 = $("input[name='three']:checked").length;

        if(inp3 == 0){
             alert("请选择想要成为哪种动物");
             return false;
         } else{
		    var i = $(this).parents(".test-style-cent").index() + 1;
			$(".test-style-box .test-style-cent").eq(i).addClass("box-this").siblings().removeClass("box-this");
		}
    })
	

			
    // 上一个
    $(".test-btn-prev").click(function () {
        var i = $(this).parents(".test-style-cent").index() - 1;
        $(".test-style-box .test-style-cent").eq(i).addClass("box-this").siblings().removeClass("box-this");

    })
    $(".test-btn-button").click(function () {
        $(".zhungxiufengge").fadeIn();
    })


});



// 随机数
var t = 200; //在这里设置刷新时间，单位是毫秒，比如1秒钟就是1000
var min = 100; //生成的最小的数字，比如200
var max = 500000; //生成的最大的数字，比如500
var maxx = 5000;
window.onload = function () {
    Refresh();
    setInterval("Refresh();", t);
}

function Refresh() {
    document.getElementById('price').innerHTML = parseInt(Math.random() * (max - min + 1) + min);
    document.getElementById('price1').innerHTML = parseInt(Math.random() * (maxx - min + 1) + min);
    document.getElementById('price2').innerHTML = parseInt(Math.random() * (maxx - min + 1) + min);
    document.getElementById('price3').innerHTML = parseInt(Math.random() * (maxx - min + 1) + min);
    document.getElementById('price4').innerHTML = parseInt(Math.random() * (maxx - min + 1) + min);
}
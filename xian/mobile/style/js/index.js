$(function () {


    $('.send-btn').click(function () {
        var sendArea = $(".send-name").val();
        var sendName = $(".send-area").val();
        var sendCont = $(".send-contact").val();
        if (sendArea == "") {
            alert("用户名不能为空")
            return false;
        } else if (sendCont.length != 11 || sendCont.substring(0, 1) != 1 || sendCont == "") {
            alert("请输入有效的手机号码")
            return false;
        };
    })


    $('.send-btn1').click(function () {
        var sendArea = $(".send-name1").val();
        var sendCont = $(".send-contact1").val();
        if (sendArea == "") {
            alert("用户名不能为空")
            return false;
        } else if (sendCont.length != 11 || sendCont.substring(0, 1) != 1 || sendCont == "") {
            alert("请输入有效的手机号码")
            return false;
        }
    })

    // 点击下图上图变化
    var topimg = $(".style-top img");
    $(".style-bto li img").click(function(){
        var i = $(this).attr("src");
        $(this).parents(".style-bto").siblings(".style-top").children("img").attr("src",i);
    })


    $("input").click(function(){
        $(".fixed-footer").hide();
    })
    $("input").blur(function(){
        $(".fixed-footer").show();
    })


    // 弹出层一
    $(".layer-x1").click(function () {
        $(".in-layer").hide();
    })

    $(".layer-click").click(function () {
        $(".in-layer2").show();
    })

    $(".layer-x2").click(function () {
        $(".in-layer2").hide();
    })

})
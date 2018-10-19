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
        } else if (sendName.length > 4 || sendName == "") {
            alert("请输入房屋正确面积")
            return false;
        }
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
    // 弹出层一
    $(".layer-tan1").click(function () {
        var data = $(this).data("toptt");
        if (data == 1) {
            $(".in-layer-text").text("免费领取30套全景案列");
        } else if (data == 2) {
            $(".in-layer-text").text("免费领取50元企业滴滴券");
        } else if (data == 3) {
            $(".in-layer-text").text("免费领取500元上门量房");
        }else{
            $(".in-layer-text").text("新品发布会 打造会呼吸的家");
        }
        $(".in-layer").show();
    })

    $(".layer-x1").click(function () {
        $(".in-layer").hide();
    })

    $(".layer-click").click(function () {
        $(".in-layer2").show();
        var data = $(this).data("num")
        if (data == 0) {
            $(".layer-text").text("凡在活动期间签约的业主，100㎡三房两厅一厨一卫送全房21件豪华家具，名额仅限前58户");
        } else if (data == 1) {
            $(".layer-text").text("凡在活动期间签约的业主，100㎡三房两厅一厨一卫全包豪华整装工厂价169800，交1万立省3万，仅需139800元,名额仅限前58户");
        } else if (data == 2) {
            $(".layer-text").text("凡在活动期间签约的业主，+1998元抢格力客餐厅中央空调+主卧1.5P美的挂机+次卧1.5P美的挂机，名额仅限前68户");
        } else if (data == 3) {
            $(".layer-text").text("凡在活动期间签约的业主，+998元抢老板烟机+老板灶具+美的热水器免费送；名额仅限前68户");
        } else if (data == 4) {
            $(".layer-text").text("凡在活动期间签约的业主，橱柜免费升级为欧派，任意卧室的硅藻泥+电视墙硅藻泥+20卷任意空间墙纸名额仅限前88户");
        } else if (data == 5) {
            $(".layer-text").text("凡在活动期间签约的业主，金牌监理 金牌项目经理 金牌设计师 服务费设计费全免，名额仅限前98户");
        } else if (data == 6) {
            $(".layer-text").text("凡在活动期间签约的业主，均使用陕西电视台推荐净教授VOC除甲醛免费送、");
        } else if (data == 7) {
            $(".layer-text").text("（三开门冰箱，7公斤滚筒洗衣机，IPAD，微波炉电饭煲,空气净化器），五选二");
        }

    })

    $(".layer-x2").click(function () {
        $(".in-layer2").hide();
    })

})
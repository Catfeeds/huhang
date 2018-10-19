function getReply() {
    // var msgData=[
    //     {cityname:"西安",name:"曹女士",time:"10秒"},
    //     {cityname:"宝鸡",name:"王先生",time:"15秒"},
    //     {cityname:"武汉",name:"梁女士",time:"20秒"},
    //     {cityname:"昆明",name:"赵先生",time:"30秒"},
    //     {cityname:"贵阳",name:"曾女士",time:"30秒"},
    //     {cityname:"西安",name:"李先生",time:"45秒"},
    //     {cityname:"昆明",name:"张先生",time:"1分钟"},
    //     {cityname:"西安",name:"胡女士",time:"2分钟"},
    //     {cityname:"武汉",name:"黄女士",time:"2分钟"},
    //     {cityname:"西安",name:"方先生",time:"3分钟"}
    // ]

    // $.ajax({
        // url: '//secure.to8to.com/zb/sem.php',
        // type: 'get',
        // cache: true,
        // dataType: 'jsonp',
        // success: function(data) {
            // var i = 0,
            //     str = '',
            //     filename;
            // for (i = 0; i < 10; i++) {
            //     filename = /\/\//.test(msgData[i].filename) ? msgData[i].filename : ("//") + msgData[i].filename;
            //     str += '<div class="msg msg' + (i + 1) + ' clearfix animated">' +
            //         '<img src="' + filename + '">' +
            //         '<span>来自' + msgData[i].cityname + '的' + msgData[i].name + '发起了申请&nbsp;&nbsp;&nbsp;&nbsp;' + msgData[i].time + '前</span>' +
            //         '</div>';
            // }
            // $('.g-msg').html(str);
            rand = Math.floor(Math.random() * 11) + 1;
            for (i = 0; i < 11; i++) {
                (function(x) {
                    setTimeout(function() {
                        showMsg((rand + x) % 11 + 1);
                    }, 5000 * (x + 1))
                })(i)
            };
        
    // })
}

function showMsg(msgIdx) {
    var $msg = $('.msg' + msgIdx);
    $msg.show().removeClass('fadeOutUp').addClass('fadeInUp');
    setTimeout(function() {
        $msg.removeClass('fadeInUp').addClass('fadeOutUp');
    }, 3000);
}

$(document).ready(function() {
    getReply();
})
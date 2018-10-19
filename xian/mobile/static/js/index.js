// 首页banner区
var swiper1 = new Swiper('#swiper-container',{
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    }
  });
//   首页banner下导航区
  var swiper2 = new Swiper('.swiper-container2',{
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    }
  });
// 六大空间轮播区
var swiper3 = new Swiper('.swiper-container3',{
    slidesPerView: 4,
    slidesPerGroup: 4,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });
// 装修流程选项卡区
$(".bz-li").click(function(){
    var $i = $(this).index();
    if($i==0){
        $i=0;
    }else{
        if($i==2){
            $i=1
        }else{
            $i=2
        }
    }
    $(this).addClass('cur').siblings().removeClass('cur');
    $(this).parent(".dt-plan").siblings(".dt-flow").children(".dt-box").eq($i).show();
    $(this).parent(".dt-plan").siblings(".dt-flow").children(".dt-box").eq($i).siblings().hide();
})
    
    //整装产品顶部预约成功
    var swiper5 = new Swiper('#product-yy', {
        direction: 'vertical',
        loop:true,
        autoplay:true,
    }); 

    //整装产品服务保障
    var swiper = new Swiper('#product-guar', {
        loop:true,
        
    });

    //整装产品12大德系工艺
    var swiper = new Swiper('#product-process', {
        slidesPerView: 2,
        spaceBetween: 5,
         
        loop:true
    });

     //最新优惠
     var swiper = new Swiper('#reser-cg', {
        direction: 'vertical',
        loop:true,
        autoplay:true,
    }); 

     //量房设计 
     var swiper = new Swiper('#reser-cg1', {
        direction: 'vertical',
        loop:true,
        autoplay:true,
    }); 

    //装修贷款
    var swiper = new Swiper('#reser-cg2', {
        direction: 'vertical',
        loop:true,
        autoplay:true,
    }); 
    // 优惠券表单验证
    $('#stores_nav1 .quan-btn').click(function(){
        oldPhone('#stores_nav1');
    })
    $('#stores_nav2 .quan-btn').click(function(){
        oldPhone('#stores_nav2');
    })
    $('#stores_nav3 .quan-btn').click(function(){
        oldPhone('#stores_nav3');
    })
    $('#stores_nav4 .quan-btn').click(function(){
        oldPhone('#stores_nav4');
    })
    //首页表单验证调用
    $('#index-center-form').click(function(){
        confirm('#ceshi1');
    })
    $('#index-form2 .sub-btn').click(function(){
        confirm('#index-form2');
    })
    $('#old-phone1 .send-btn').click(function(){
        oldPhone('#old-phone1');
    })
    $('#old-phone2 .quan-btn').click(function(){
        oldPhone('#old-phone2');
    })
    $('#old-phone3 .quan-btn').click(function(){
        oldPhone('#old-phone3');
    })

    //免费设计表单验证调用
    $('#design-form1 .sub-btn').click(function(){
        confirm('#design-form1');
    })
    $('#design-form2 .sub-btn').click(function(){
        confirm('#design-form2');
    })
    $('#design-q1 .quan-btn').click(function(){
        oldPhone('#design-q1');
    })
    $('#design-q2 .quan-btn').click(function(){
        oldPhone('#design-q2');
    })
    //整装产品表单验证调用
    $('#product-form1 .sub-btn').click(function(){
        newPhone('#product-form1');
    })
    $('#product-form2 .sub-btn').click(function(){
        confirm('#product-form2');
    })
    $('#product-q1 .quan-btn').click(function(){
        oldPhone('#product-q1');
    })
    $('#product-q2 .quan-btn').click(function(){
        oldPhone('#product-q2');
    })
    //装修报价表单验证调用
    $('#quote-form1 .ys-btn').click(function(){
        confirm('#quote-form1');
    })
    $('#quote-q1 .quan-btn').click(function(){
        oldPhone('#quote-q1');
    })
    $('#quote-q2 .quan-btn').click(function(){
        oldPhone('#quote-q2');
    })
    //装修贷款表单验证调用
    $('#loans-form1 .sub-btn').click(function(){
        cPhone('#loans-form1');
    })
    $('#loans-form2 .sub-btn').click(function(){
        cMoney('#loans-form2');
    })
    $('#loans-form3 .sub-btn').click(function(){
        confirm('#loans-form3');
    })
    $('#loans-q1 .quan-btn').click(function(){
        oldPhone('#loans-q1');
    })
    $('#loans-q2 .quan-btn').click(function(){
        oldPhone('#loans-q2');
    })
    //最新优惠表单验证调用
    $('#activity-form1 .sub-btn').click(function(){
        confirm('#activity-form1');
    })
    $('#activity-form2 .sub-btn').click(function(){
        confirm('#activity-form2');
    })
    $('#activity-q1 .quan-btn').click(function(){
        oldPhone('#activity-q1');
    })
    $('#activity-q2 .quan-btn').click(function(){
        oldPhone('#activity-q2');
    })
    //装修报价表单验证调用
    $('#drops-form1 .sub-btn').click(function(){
        confirm('#drops-form1');
    })
    $('#drops-q1 .quan-btn').click(function(){
        oldPhone('#drops-q1');
    })
    $('#drops-q2 .quan-btn').click(function(){
        oldPhone('#drops-q2');
    })

    //验证函数代码  
    function confirm(id){
        var ch = $(id).find(".nickname").val();
        var dh = $(id).find(".tel").val();
        var mj = $(id).find(".area").val();
        if (ch =="" && dh =="" && mj =="") {
            alert("请输入您的称呼、电话号码和面积!");
            event.preventDefault();
        }else if(ch ==""){
            alert('请输入您的称呼！');
            event.preventDefault();
        }else if(dh ==""){
            alert('请输入您的手机号码');
            event.preventDefault();
        }else if(mj ==""){
            alert('请输入您的房屋面积');
            event.preventDefault();
        }else if(dh.length !=11 || dh.substring(0,1)!=1  ){
            alert("输入的手机号码格式错误！");
            event.preventDefault();
        }else{
        	return true;
            alert('提交成功!');
            
        }
    }

    function oldPhone(id){
        var dh = $(id).find(".tel").val();
        if(dh == ""){
            alert('请输入您的手机号码');
            event.preventDefault();   
        }else if(dh.length !=11 || dh.substring(0,1)!=1){
            alert('输入的手机号码格式错误！');
            event.preventDefault();
        }else{
        	return true;
            alert('提交成功!')
            
        }
    }


    function newPhone(id){
        var dh = $(id).find(".tel").val();
        var mj = $(id).find(".area").val();
        if (dh =="" && mj =="") {
            alert("请输入您的电话号码和面积!");
            event.preventDefault();
        }else if(dh ==""){
            alert('请输入您的手机号码');
            event.preventDefault();
        }else if(mj ==""){
            alert('请输入您的房屋面积');
            event.preventDefault();
        }else if(dh.length !=11 || dh.substring(0,1)!=1  ){
            alert("输入的手机号码格式错误！");
            event.preventDefault();
        }else{
        	return true;
            alert('提交成功!')
            
        }
    }
            
        
    function cPhone(id){
        var ch = $(id).find(".nickname").val();
        var dh = $(id).find(".tel").val();
         
        if (ch =="" && dh =="") {
            alert("请输入您的称呼、电话号码!");
            event.preventDefault();
        }else if(ch ==""){
            alert('请输入您的称呼！');
            event.preventDefault();
        }else if(dh ==""){
            alert('请输入您的手机号码');
            event.preventDefault();
        }else if(dh.length !=11 || dh.substring(0,1)!=1  ){
            alert("输入的手机号码格式错误！");
            event.preventDefault();
        }else{
        	return true;
            alert('提交成功!')
            
        }
    }

    function cMoney(id){
        var je = $(id).find(".nickname").val();
        var dh = $(id).find(".tel").val();
         
        if (je =="" && dh =="") {
            alert("请输入您的贷款金额、电话号码!");
            event.preventDefault();
        }else if(je ==""){
            alert('请输入您的贷款金额！');
            event.preventDefault();
        }else if(dh ==""){
            alert('请输入您的手机号码');
            event.preventDefault();
        }else if(dh.length !=11 || dh.substring(0,1)!=1  ){
            alert("输入的手机号码格式错误！");
            event.preventDefault();
        }else{
        	return true;
            alert('提交成功!')
            
        }
    }
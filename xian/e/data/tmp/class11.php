<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no;" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>千百炼装饰-免费设计</title>
    <meta content="西安装修公司排名,西安装修公司,西安十大装修公司,西安品牌装修公司,西安家庭装修,西安室内装修,西安装饰公司,西安装修公司哪家好,西安千百炼装饰公司,西安千百炼装修公司,西安千百炼装饰,千百炼装修,千百炼装饰" name="keywords">
	<meta content="千百炼家装集团，是一家专注于整体家装服务的集团化公司，旨在为业主提供家装一站服务的完美解决方案。装修热线：400-029-1986" name="description">
    <script src="/mobile/static/js/flexible.js"></script>
    <link rel="stylesheet" href="/mobile/static/css/common.css">
    <link rel="stylesheet" href="/mobile/static/css/swiper-3.4.2.min.css">
    <link rel="stylesheet" href="/mobile/static/css/style.css">
    <link rel="stylesheet" href="/mobile/static/css/design.css">

    <style>
        .triangle-rt{
            border-left:0.24rem solid #c70000;
            border-top:0.24rem solid transparent; 
            border-bottom:0.24rem solid transparent;
            position: absolute;
            top:0.12rem;
            right:-0.2rem;
        }
        .triangle-lt{
            border-right:0.24rem solid #c70000;
            border-top:0.24rem solid transparent; 
            border-bottom:0.24rem solid transparent;
            position: absolute;
            top:0.12rem;
            left:-0.2rem;
        }
    </style>
</head>
<body ontouchstart>   
    <!-- 顶部变量模板 -->
           <nav class="nav-ul-index">
        <i></i>
        <ul>
            <li>
                <a href="/mobile/index.html">
                    <img src="/mobile/static/images/navicon01.png" />
                    <p>网站首页</p>
                </a>
            </li>
            <li>
                <a href="/mobile/design/index.html">
                    <img src="/mobile/static/images/navicon06.png" />
                    <p>量房设计</p>
                </a>
            </li>
            <li>
                <a href="/mobile/product/index.html">
                    <img src="/mobile/static/images/navicon02.png" />
                    <p>整装产品</p>
                </a>
            </li>
            <li>
                <a href="/mobile/quote/index.html">
                    <img src="/mobile/static/images/navicon04.png" />
                    <p>装修报价</p>
                </a>
            </li>
            <li>
                <a href="tel:400-029-1986">
                    <img src="/mobile/static/images/navicon09.png" />
                    <p>电话咨询</p>
                </a>
            </li>
            <li>
                <a href="/mobile/loans/index.html">
                    <img src="/mobile/static/images/navicon03.png" />
                    <p>装修贷款</p>
                </a>
            </li>
            <li>
                <a href="/mobile/activity/index.html">
                    <img src="/mobile/static/images/navicon05.png" />
                    <p>最新优惠</p>
                </a>
            </li>
            <li>
                <a href="/mobile/drops/index.html">
                    <img src="/mobile/static/images/navicon07.png" />
                    <p>滴滴接驾</p>
                </a>
            </li>
            <li>
                <a href="/mobile/stores_nav/index.html">
                    <img src="/mobile/static/images/navicon08.png" />
                    <p>门店导航</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- 导航 end -->
     <!-- 头部 begin -->
    <header class="header">
        <!-- logo begin -->
        <div class="logo">
            <a href="/mobile/index.html">
                <img src="/mobile/static/images/logo.png" alt="">
            </a>
        </div>
        <!-- logo end -->
        <!-- 城市分区 begin -->
        <div class="city">
            <div class="head-city">
                <a href="javascript:;" class="cityshow">
                    西安
                </a>
                <i class="xiala"></i>
            </div>
            <ul class="city-list">
                <li><h3>选择城市</h3></li>
                <li class="citys"><a href="xian.qblzs.com.cn">西安</a></li>
                <li class="citys"><a href="wuhan.qblzs.com.cn">武汉</a></li>
                <li class="citys"><a href="kunming.qblzs.com.cn">昆明</a></li>
                <li class="citys"><a href="baoji.qblzs.com.cn">宝鸡</a></li>
                <li class="citys"><a href="guiyang.qblzs.com.cn">贵阳</a></li>
            </ul>
        </div>
        <!-- 城市分区 end -->
        <i class="nav-icon"></i>
    </header>
    <!-- banner区 begin -->
    <section class="banner design-banner">
    <img src="/mobile/static/images/sl3.gif">
    </section>
    <!-- banner区 end -->
    <!-- 限时免费设计 begin -->
    <section class="vr-show design-show">
        <form id="design-form1" class="form-center all-form" name='feedback' method='post' enctype='multipart/form-data' action='/e/enews/index.php'>
            <input type=hidden name=ecmsfrom value="/mobile/design/index.html"> 
            <input name='enews' type='hidden' value='AddFeedback'>
            <input name='title' type='hidden' value='设计量房头部表单'> 
            <input type=hidden name=bid value=1> 
            <input type=hidden name=laiyuan id=laiyuan>                   
            <input type=hidden name=chuangyi id=chuangyi>
            <!-- 有效表单 begin -->
            <input type="text" name="name" id="nickname" class="nickname" placeholder="请输入您的称呼">
            <input type="tel" name="mycall" id="tel" class="tel" placeholder="请输入您的手机号码">
            <label class="all-mj"><input type="tel" name="mianji" id="area" class="area" placeholder="请输入您的房屋面积"><i>㎡</i></label>
             
            <input type="submit" value="限时免费设计全景效果图" class="sub-btn">
        </form>
    </section>
    <!-- 限时免费设计 end -->
    
    <!--预约成功-->
    <section class="reservations">
        <i class="fl">
            <img src="/mobile/static/images/s14.png" />
        </i>
        <div class="swiper-container swiper-no-swiping" id="reser-cg1">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <span class="">2分钟前</span>
                    <span class="">119㎡</span>
                    <span class="">159****1266</span>
                </div>
                <div class="swiper-slide">
                    <span class="">15分钟前</span>
                    <span class="">119㎡</span>
                    <span class="">159****1266</span>
                </div>
                <div class="swiper-slide">
                    <span class="">10分钟</span>
                    <span class="">119㎡</span>
                    <span class="">159****1266</span>
                </div>
                <div class="swiper-slide">
                    <span class="">5分钟前</span>
                    <span class="">119㎡</span>
                    <span class="">159****1266</span>
                </div>
                <div class="swiper-slide">
                    <span class="">2分钟前</span>
                    <span class="">119㎡</span>
                    <span class="">159****1266</span>
                </div>
                <div class="swiper-slide">
                    <span class="">15分钟前</span>
                    <span class="">119㎡</span>
                    <span class="">159****1266</span>
                </div>
                <div class="swiper-slide">
                    <span class="">10分钟</span>
                    <span class="">119㎡</span>
                    <span class="">159****1266</span>
                </div>
                <div class="swiper-slide">
                    <span class="">5分钟前</span>
                    <span class="">119㎡</span>
                    <span class="">159****1266</span>
                </div>
            </div>
        </div>
        
    </section>
    <!--预约成功 end-->
    
    <!--量房3部曲-->
    <section class="amoun-room">
        <ul>
           
            <li>
                <img src="/mobile/static/images/s11.png"/>
                <p>
                    <h5>1</h5>
                    <font>在线预约</font>
                    <font>免费设计</font>
                </p>
            </li>
           
            <li>
                <img src="/mobile/static/images/s12.png"/>
                <p>
                    <h5>2</h5>
                    <font>上门测量</font>
                    <font>沟通需求</font>
                </p>
            </li>
            <li>
                <img src="/mobile/static/images/s13.png"/>
                <p>
                    <h5>3</h5>
                    <font>720°全景</font>
                    <font>免费出图</font>
                </p>
            </li>
            <div style="clear:both"></div>
            <span class="sp1"></span>
            <span class="sp2"></span>
        </ul>
    </section>
    <!--量房3部曲 end-->

    <!--只需3步，720全景展现-->
    <section class="whole-show">
        <h2>只需三步，720全景呈现</h2>
        <ul>
            <li>
                <span class="img">
                    <img src="/mobile/static/images/sl11.png" />
                </span>
                <span class="text">
                    <font>第一步</font>
                    <font>户型图</font>
                </span>
            </li>
            <li>
                <span class="img">
                    <img src="/mobile/static/images/sl22.png" />
                </span>
                <span class="text">
                    <font>第二步</font>
                    <font>效果图</font>
                </span>
            </li>
            <li>
                <span class="img">
                    <img src="/mobile/static/images/sl33.png" />
                </span>
                <span class="text">
                    <font>第三步</font>
                    <font>实景图</font>
                </span>
            </li>
        </ul>
    </section>
    <!--只需3步，720全景展现 end-->
     
    <!--送增值服务-->
    <section class="added-service">
        <h2>送增值服务</h2>
        <p>
            <img src="/mobile/static/images/s111.jpg" />
        </p>
        <p>
            <img src="/mobile/static/images/s222.jpg" />
        </p>
    </section>
    <!--送增值服务 end-->
    
    <!--你敢来我管接-->
    <section class="shuttle-bus">
        <h2>你敢来我Guan接</h2>
        <p>
            <img src="/mobile/static/images/t6.png"/>
        </p>
    </section>

    <!-- 全球采集 begin -->
    <section class="global zero-price ">
        <form id="design-form2" class="form-center all-form" id="zero-price-form" name='feedback' method='post' enctype='multipart/form-data' action='/e/enews/index.php'>
            <input type=hidden name=ecmsfrom value="/mobile/design/index.html"> 
            <input name='enews' type='hidden' value='AddFeedback'>
            <input name='title' type='hidden' value='免费量房底部表单'> 
            <input type=hidden name=bid value=1> 
            <input type=hidden name=laiyuan id=laiyuan>                   
            <input type=hidden name=chuangyi id=chuangyi>
            <!-- 有效表单 begin -->
            <input type="text" name="name" id="nickname" class="nickname" placeholder="请输入您的称呼">
            <input type="tel" name="mycall" id="tel" class="tel" placeholder="请输入您的手机号码">
            <label class="all-mj"><input type="tel" name="mianji" id="area" class="area" placeholder="请输入您的房屋面积"><i>㎡</i></label>
             
            <input type="submit" value="立即抢0元报价" class="sub-btn">
        </form>
        <ul class="ticket">
                <li class="sjbtn">
                    <div class="quan-box">
                        <p class="q-price">500</p>
                        <p class="q-unit">￥</p>
                        <p class="q-line"></p>
                        <p class="q-rule">定金满5000可用</p>
                        <p class="q-type">设计券</p>
                        <p class="q-btn">立即领取</p>
                        <p class="q-num">已领<strong class="nums">51</strong>张</p>
                    </div>
                </li>
                <li class="lfbtn">
                    <div class="quan-box">
                            <p class="q-price">800</p>
                            <p class="q-unit">￥</p>
                            <p class="q-line"></p>
                            <p class="q-rule">活动期间可用</p>
                            <p class="q-type">量房券</p>
                            <p class="q-btn">立即领取</p>
                            <p class="q-num">已领<strong class="nums">189</strong>张</p>
                        </div>
                </li>
            </ul>
            
            <div class="quan-form sj-quan">
                <form id="design-q1" class="form-center" name='feedback' method='post' enctype='multipart/form-data' action='/e/enews/index.php'>
                    <p class="yhq-title">设计优惠券</p>
                    <img src="/mobile/static/images/close.png" alt="" class="close">
                    <input type=hidden name=ecmsfrom value="/mobile/design/index.html"> 
                    <input name='enews' type='hidden' value='AddFeedback'>
                    <input name='title' type='hidden' value='免费设计500元优惠券表单'> 
                    <input type=hidden name=bid value=1> 
                    <input type=hidden name=laiyuan id=laiyuan>                   
                    <input type=hidden name=chuangyi id=chuangyi>
                    <!-- 有效表单 begin -->
                    <input type="tel" name="mycall" id="tel" class="tel" placeholder="请输入您的手机号码">
                    <input type="submit" value="立即领取优惠券" class="quan-btn">
                </form>
            </div>
            <div class="quan-form lf-quan">
                <form id="design-q2" class="form-center" name='feedback' method='post' enctype='multipart/form-data' action='/e/enews/index.php'>
                    <p class="yhq-title">量房优惠券</p>
                    <img src="/mobile/static/images/close.png" alt="" class="close">
                    <input type=hidden name=ecmsfrom value="/mobile/design/index.html"> 
                    <input name='enews' type='hidden' value='AddFeedback'>
                    <input name='title' type='hidden' value='免费设计800元优惠券表单'> 
                    <input type=hidden name=bid value=1> 
                    <input type=hidden name=laiyuan id=laiyuan>                   
                    <input type=hidden name=chuangyi id=chuangyi>
                    <!-- 有效表单 begin -->
                    <input type="tel" name="mycall" id="tel" class="tel" placeholder="请输入您的手机号码">
                    <input type="submit" value="立即领取优惠券" class="quan-btn">
                </form>
            </div>
    </section>

    <!-- 底部变量模板 -->
        <section class="quote-price">
        <a href="tel:400-029-1986" class="zx">免费咨询</a><a href="/mobile/quote/index.html" class="bj">快速报价</a>
    </section>
    <!-- 底部 begin -->
    <footer>
        <h3>装修不到千百炼   要花不少冤枉钱</h3>
        <p>千百炼@Copyright版权所有</p>
        <p>陕ICP备17003733号</p>
    </footer>
    
    <script src="/mobile/static/js/jquery-1.8.3.min.js"></script>
    <script src="/mobile/static/js/swiper-3.4.2.min.js"></script>
    <script src="/mobile/static/js/common.js"></script>
    <script src="/mobile/static/js/index.js"></script>  
    <script>
        if (window.devicePixelRatio && devicePixelRatio >= 2) {
            document.querySelector('body').classList.add('hairlines')
        }
    </script>
	<!-- 来源_分析 -->
	    <script>  
        function getUrlParms(name){  
            var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");  
            var r = window.location.search.substr(1).match(reg);  
            if(r!=null)  
                return unescape(r[2]);  
                return null;  
        }  
        document.getElementById("laiyuan").value=getUrlParms("laiyuan");  
        document.getElementById("chuangyi").value=getUrlParms("chuangyi");  
    </script>  
	<!-- 获取号码 -->
	[!--temp.zhuaqu--]
	<!-- 统计_客服 -->
       <!--53客服-->
<script>(function() {var _53code = document.createElement("script");_53code.src = "https://tb.53kf.com/code/code/10151974/1";var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(_53code, s);})();</script>
   <!--站长统计-->
   <script src="https://s13.cnzz.com/z_stat.php?id=1273005258&web_id=1273005258" language="JavaScript"></script>
   <!--百度统计-->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?2cb05ffa737ee9115d5021bdd41be3f1";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script> 
</body>
</html>
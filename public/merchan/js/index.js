/*
 * @Author: caolei 
 * @Date: 2018-06-06 14:45:04 
 * @Last Modified by: caolei
 * @Last Modified time: 2018-07-04 11:26:15
 */

$(function () {

    $(".office-tab-btn span").on('click', function () {
        var _this = $(this);
        var _thisI = $(this).index();
        var tabcon = $('.office-tab-contain li');
        _this.addClass('btn-this').siblings().removeClass('btn-this');
        tabcon.eq(_thisI).show().siblings().hide();
    })


    $(".paging-con a").on('click', function () {
        var i = $(this);
        i.addClass('paging-this').siblings().removeClass('paging-this')
    })


    $(".media .swiper-slide").on("click", function () {
        $(this).css('border', '2px solid #E9131B').siblings().css('border', '2px solid transparent')
        $(this).parents(".swiper-wrapper").init();
    })


    // 大家都在看
    $('.watching-item').hover(function () {
        var _this = $(this);
        _this.siblings('.watching-item').children('a').children('.watching-content').children('img').hide();
        _this.children('a').children('.watching-content').children('img').show();
    })

    // 投诉建议

    $('.compla-tab-menu li').on('click', function () {
        $(this).addClass('compla-tab-this').siblings().removeClass('compla-tab-this')
    })




    $(".drop-down-container").hover(function () {
        $(this).css({
            'background': '#fff',
            'border-left': '1px solid #ddd',
            'border-right': '1px solid #ddd',
            'border-bottom': '1px solid #ddd',
        })
        $(".drop-down-item").stop(true, false).fadeIn(300);

    }, function () {
        $(".drop-down-item").stop(true, false).fadeOut(300);
        $(this).css({
            'background': '#f5f5f5',
            'border-left': '1px solid transparent',
            'border-right': '1px solid transparent',
            'border-bottom': '1px solid transparent',
        })
    })



    $(".qp-img .layui-icon-close").click(function () {
        $(this).parents(".qp-img").hide();
    })

    $(".gallery-top .swiper-slide span").on('click', function () {
        var _this = $(this),
            _thisImg = _this.prev('img').attr('src'),
            fuzhi = $(".fuzhi-img");
        fuzhi.attr('src', _thisImg)
        $(".qp-img").show();

    })




    

    $(".release-item li").on('click',function(){
        $(this).children('span').css('border','1px solid #E9131B');
        $(this).children('p').css('color','#E9131B');
        $(this).children('span').addClass('checkeds');

        $(this).siblings().children('span').css('border','1px solid #ddd');
        $(this).siblings().children('p').css('color','#666');
        var textP = $(this).children('p').text();
        //console.log(textP);
        $(".leixing").val(textP)
    })


})
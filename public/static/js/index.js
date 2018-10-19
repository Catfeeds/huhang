/*
 * @Author: caolei 
 * @Date: 2018-06-06 14:45:04 
 * @Last Modified by: caolei
 * @Last Modified time: 2018-07-04 13:28:32
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


    // 城市选择
    $(".city-con-bg").hover(function () {
        var _this = $(this);
        _this.css({
            'background': '#FFFBFB',
            'border-left': '1px solid #ddd',
            'border-right': '1px solid #ddd',
        });
        $(".city-item").stop(true, false).fadeIn(300);
    }, function () {
        var _this = $(this);
        _this.css({
            'background': '#F5F5F5',
            'border': '1px solid transparent',
        });
        $(".city-item").stop(true, false).fadeOut(300);
    })

    $('.city-item-title span').click(function () {
        $(this).css({
            'border-bottom': '2px solid #E9131B',
        }).siblings().css({
            'border-bottom': '2px solid transparent',
        })

        $(this).children('a').css('color', '#E9131B').parents('span').siblings().children('a').css('color', '#555')
    })



    $(".drop-down-container").hover(function () {
        $(this).css({
            'background': '#fff',
            'border-left': '1px solid #ddd',
            'border-right': '1px solid #ddd',
            'border-bottom': '1px solid #ddd',
        })
        $(this).children(".drop-down-item").stop(true, false).fadeIn(300);

    },function(){
        $(this).children(".drop-down-item").stop(true, false).fadeOut(300);
        $(this).css({
            'background': '#f5f5f5',
            'border-left': '1px solid transparent',
            'border-right': '1px solid transparent',
            'border-bottom': '1px solid transparent',
        })
    })



    $(".top-phone-rwm").hover(function(){
        $(this).css('background','#fff')
        $(".top-phone-item").stop(true, false).fadeIn(300);

    },function(){
        $(this).css('background','#f5f5f5')
        $(".top-phone-item").stop(true, false).fadeOut(300);
    })






})
$(document).ready(function () {

    $(".select_btn").on('click', 'label', function () {
        $(this).siblings("span").addClass("active");
        $(this).parent().siblings("div").find("span").removeClass("active");
        var price = $(this).attr("data-price");
        $("#cart_price").html("￥" + price).attr("data-price", price);
    });

    $(".list_menu").on('click', '.li', function () {
        $('.on').removeClass('on');
        $(this).addClass('on');
    });

    $('.fade').click(function () {
        $('.show_box').hide();
        $('.fade').hide();
    });
    $('.close_box').click(function () {
        $('.show_box').hide();
        $('.fade').hide();
    });

    $("#cartShow").click(function () {
        var num = $(".cart_box > dl").length;//如果购物车里面有条目才显示
        if (num) {
            $(".pop_box").slideToggle(500);
            $('#fade').show();
        }
    });
    $('#fade').click(function () {
        $('.pop_box').hide();
        $('#fade').hide();
    });

    var clickNumber = 0;
    $('#cartShow').click(function () {
        if (clickNumber % 2 == 0) {
            //他显示
        } else {
            $('#fade').hide();
        }
        clickNumber++;
    });
    $('#fade').click(function () {
        if (clickNumber % 2 == 0) {
            //他显示
        } else {
            $('#fade').hide();
        }
        clickNumber++;
    });


    var winHeight = $(document).scrollTop();

    $(window).scroll(function () {
        //滚动定位标红分类
        var _top = $(window).scrollTop();
        var _all = -50;
        for (var i = 0; i < $('.list_cont').length; i++) {
            _length = $('.list_cont').eq(i).height();
            if (_all <= _top && _top < (_all + _length)) {
                $('.list_menu .on').removeClass('on');
                $('.list_menu .li').eq(i).addClass('on');
                var _menu = i * 57;
                $('.list_menu').scrollTop(_menu);

            }
            _all += $('.list_cont').eq(i).height();
        }

        //滚动自动置顶

        var scrollY = $(document).scrollTop();// 获取垂直滚动的距离，即滚动了多少

        if (scrollY > 100) {
            $('.list_top').slideUp(200, function () {
                $('.list_top').addClass('hiddened');
            });
            $('.list_menu').addClass('hiddened1');
        }
        else {
            $('.list_top').slideDown(100, function () {
                $('.list_top').removeClass('hiddened');
            });
            $('.list_menu').removeClass('hiddened1');
        }

        if (scrollY > winHeight) { //如果没滚动到顶部，删除显示类，否则添加显示类
            $('.list_top').removeClass('showed');
            $('.list_menu').removeClass('showed1');
        }
        else {
            $('.list_top').addClass('showed');
            $('.list_menu').addClass('showed1');
        }

    });

});
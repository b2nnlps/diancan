// JavaScript Document
$(document).ready(function () {

    $("#main_visual").hover(function () {
        $("#btn_prev,#btn_next").fadeIn()
    }, function () {
        $("#btn_prev,#btn_next").fadeOut()
    });

    $dragBln = false;

    $(".main_image").touchSlider({
        flexible: true,
        speed: 50,
        btn_prev: $("#btn_prev"),
        btn_next: $("#btn_next"),
        mouseTouch: false,
        paging: $(".flicking_con a"),
        counter: function (e) {
            $(".flicking_con a").removeClass("on").eq(e.current - 1).addClass("on");
        }
    });

    $(".main_image").bind("mousedown", function () {
        $dragBln = false;
    });

    $(".main_image").bind("dragstart", function () {
        $dragBln = false;
    });

    $(".main_image a").click(function () {
        if ($dragBln) {
            return false;
        }
    });

    if ($(".flicking_con").children().length > 1)
        timer = setInterval(function () {
            $("#btn_next").click();
        }, 5000);

    $("#main_visual").hover(function () {
        clearInterval(timer);
    }, function () {
        if ($(".flicking_con").children().length > 1)
            timer = setInterval(function () {
                $("#btn_next").click();
            }, 5000);
    });

    $(".main_image").bind("touchstart", function () {
        return false;
    }).bind("touchend", function () {
        if ($(".flicking_con").children().length > 1)
            timer = setInterval(function () {
                $("#btn_next").click();
            }, 5000);
    });

});
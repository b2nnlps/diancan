$(document).ready(function () {
    $(".plus a").click(function () {
        $(".show_box").show();
        $('.fade').show();
    });
    $('.fade').click(function () {
        $('.show_box').hide();
        $('.fade').hide();
    });
    $('.close_box').click(function () {
        $('.show_box').hide();
        $('.fade').hide();
    });

});
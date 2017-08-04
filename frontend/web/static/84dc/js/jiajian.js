// JavaScript Document
$(function () {
    //加的效果
    $(".gw_add").click(function () {
        var n = $(this).prev().val();
        var num = parseInt(n) + 1;
        $(this).prev().val(num);
        var danjia = $(this).next().text();//获取单价
        var total = $("#totalpriceshow_v1").html();//获取当前所选总价
        $("#totalpriceshow_v1").html((total * 1 + danjia * 1).toFixed(2));//计算当前所选总价

        var total_num = $("#totalpriceshow_v1").html();//获取数量
        $("#totalpriceshow_v1").html(total_num * 1 + 1);
        jss();//<span style='font-family: Arial, Helvetica, sans-serif;'></span>   改变按钮样式
    });
    //减的效果
    $(".gw_minus").click(function () {
        var n = $(this).next().val();
        var num = parseInt(n) - 1;
        if (num <= 0) {
            return 0;
        }
        $(this).next().val(num);
    });
});  


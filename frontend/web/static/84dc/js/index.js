//选规格按钮
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
//选规格操作
$(".list_box").on('click', '.plus a', function () {
    $(".show_box").fadeIn(500);
    $(".fade").fadeIn(500);
    var food = $(this).parent().parent();
    var img = $(food).parent().find("img").attr('src');
    var name = $(food).find("p").text();
    var price = $(food).find("b").text();
    $("#cart_img").attr('src', img);
    $("#cart_name").html(name);
    var id = $(this).attr("data-id");
    var info = foodInfo[id];
    text = "";
    for (i = 0; i < info.length; i++) {
        text += '<div class="norm"><label for="norm' + i + '" data-price="' + info[i].price + '"><input type="radio" name="sex" id="norm' + info[i].id + '" value="' + info[i].id + '">' + info[i].title + '</label><span class="btn">' + info[i].title + '</span></div>';
    }
    $("#cart_info").html(text);
});
//购物车操作
$(".cart_add").click(function () {
    var n = $(this).prev().text();
    var num = parseInt(n) + 1;
    if (num == 0) {
        return;
    }
    $(this).prev().text(num);
});
//减的效果
$(".cart_minus").click(function () {
    var n = $(this).next().text();
    var num = parseInt(n) - 1;
    if (num == 0) {
        $(this).parent().parent().remove();
        checkCart();//检测是否还有购物车元素，没有则关闭购物车
        return;
    }
    $(this).next().text(num);
});

//加的效果
$(".list_box").on('click', '.index_add', function () {
    $(this).prevAll().css("display", "inline-block");
    var n = $(this).prev().text();
    var num = parseInt(n) + 1;
    if (num == 0) {
        return;
    }
    $(this).prev().text(num);
    var price = $(this).parent().attr("data-price");//获取单价
    var total = $("#totalpriceshow").html();//获取当前所选总价

    $("#totalpriceshow").html((total * 1 + price * 1).toFixed(2));//计算当前所选总价
    var total_num = $("#totalcountshow").html();//获取数量
    $("#totalcountshow").html(total_num * 1 + 1);

    var info_id = $(this).parent().attr("data-id");//获取的是food_id
    var name = $(this).parent().attr("data-name");
    info = foodInfo[info_id];//查找规格
    updateCookie(info[0].id, 1, price, name, "");

    jss();
});
//减的效果
$(".list_box").on('click', '.index_minus', function () {
    var n = $(this).next().text();
    var num = parseInt(n) - 1;

    $(this).next().text(num);//减1

    var danjia = $(this).parent().attr("data-price");//获取单价
    var total = $("#totalpriceshow").html();//获取当前所选总价
    $("#totalpriceshow").html((total * 1 - danjia * 1).toFixed(2));//计算当前所选总价

    var total_num = $("#totalcountshow").html();//获取数量
    $("#totalcountshow").html(total_num * 1 - 1);
    //如果数量小于或等于0则隐藏减号和数量
    if (num <= 0) {
        $(this).next().css("display", "none");
        $(this).css("display", "none");
        jss();//改变按钮样式
    }
    var info_id = $(this).parent().attr("data-id");//获取的是food_id
    var name = $(this).parent().attr("data-name");
    var info = foodInfo[info_id];//查找规格
    updateCookie(info[0].id, -1, 0, name, "");

});
function jss() {//如果是0隐藏按钮
    var m = $("#totalcountshow").html();
    if (m > 0) {
        $(".right").find("a").removeClass("disable");
    } else {
        $(".right").find("a").addClass("disable");
    }
};
function checkCart() {//检测是否还有购物车元素，没有则关闭购物车
    var num = $(".cart_box > dl").length;
    if (!num) {
        $(".pop_box").hide();
        $("#fade").hide();
    }
}

$(".affirm_boxv1").click(function () {
    var info_id = $('input:radio[name="sex"]:checked').val();//获取详情页的信息
    if (info_id != undefined) {//如果有选中
        var name = $('#cart_name').text();
        var price = $('#cart_price').attr("data-price");
        var num = $('#cart_num').val();
        var text = $('#cart_text').val();
        updateCookie(info_id, num, price, name, text);
        layer.msg('加入购物车成功', {icon: 1});
        $(".show_box").fadeOut(500);
        $(".fade").fadeOut(500);
    } else {
        layer.msg('请选择规格', {icon: 0});
    }

});

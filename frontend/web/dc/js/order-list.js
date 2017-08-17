var orders = [];

function getOrderList(status) {//拉取订单
    $.ajax({
        url: 'http://ms.n39.cn/food/api/get-order-list?status=' + status + '&' + addUrl,
        dataType: 'jsonp',
        data: '',
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            res = res.data;
            showList(res, status);
        },
        error: function () {
            console.log('加载失败');
        },
        complete: function (XMLHttpRequest, status) { //请求完成后最终执行参数
            if (status == 'timeout' || status == 'error') {//超时,status还有success,error等值的情况
                console.log(status);
            }
            if (status == 'success') {
            }
        }
    });
}

function getOrderDetail(order_id) {//获取订单详情信息
    var index = layer.load(0, {shade: false});
    $.ajax({
        url: 'http://ms.n39.cn/food/api/get-order-detail?order_id=' + order_id + '&' + addUrl,
        dataType: 'jsonp',
        data: '',
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            layer.close(index);
            res = res.data;
            showDetail(res);
        },
        error: function () {
            console.log('加载失败');
        },
        complete: function (XMLHttpRequest, status) { //请求完成后最终执行参数
            if (status == 'timeout' || status == 'error') {//超时,status还有success,error等值的情况
                console.log(status);
            }
            if (status == 'success') {
            }
        }
    });
}

function printOrder(order_id) {//获取订单详情信息
    layer.confirm('订单ID：' + order_id, {
        title: '是否打印？',
        closeBtn: 0,
        btn: ['是', '否'] //按钮

    }, function () {
        var index = layer.load(0, {shade: false});
        $.ajax({
            url: 'http://ms.n39.cn/food/api/print-order?order_id=' + order_id + '&' + addUrl,
            dataType: 'jsonp',
            data: '',
            jsonp: 'callback',
            timeout: 5000,
            success: function (res) {
                layer.close(index);
                layer.msg('打印成功', {icon: 1});
            },
            error: function () {
                console.log('加载失败');
                layer.close(index);
            },
            complete: function (XMLHttpRequest, status) { //请求完成后最终执行参数
                if (status == 'timeout' || status == 'error') {//超时,status还有success,error等值的情况
                    console.log(status);
                }
                if (status == 'success') {
                }
                layer.close(index);
            }
        });
    }, function () {
    });

}

function showList(res, status) {
    var i, text = "", len = res.length;
    var o;
    if (len == 0 && status == 1) $("#jxzHint").show();
    if (len == 0 && status == 2) $("#ywcHint").show();
    for (i = 0; i < len; i++) {
        if (orders.indexOf(res[i].id) == -1) {
            orders.push(res[i].id);
            newMess = true;

            text = '<div id="ul' + res[i].id + '"><ul><li class="clearfix"><h4>订单ID：' + res[i].id + '</h4>';
            text += '<span class="unpaid_box" style="color:#00A75A; border:1px solid #00A75A;" onClick="printOrder(' + res[i].id + ')">打印</span>';
            text += '<span class="unpaid_box" style="color:#3C8DBD; border:1px solid #3C8DBD; margin:0 5px; " onClick="detail(' + "'" + res[i].table + "'," + res[i].id + ')">查看</span></li>';
            text += '<li class="clearfix" style="border:none;margin-bottom:-10px;"><h4>桌号：' + res[i].table + '</h4><span class="consume_box">￥' + res[i].total + '</span></li>';
            text += '<li class="clearfix"><h4 class="time_box">下单时间：' + res[i].created_time + '</h4><span style="color:#A0A3A5; font-size:14px;">' + res[i].people + '人就餐</span></li>';
            if ((res[i].text).length > 0)
                text += '<div class="hint_box"><img src="images/tishi.png" width="15" height="15"/>' + res[i].text + '</div>';
            text += '</ul><div class="blank_box"></div></div>';

            if (status == 1) {
                var html = $("#jxz").html();
                $("#jxz").html(text + html);
                $("#jxzHint").hide();
            }

            if (status == 2) {
                var html = $("#ywc").html();
                $("#ywc").html(text + html);
                $("#ywcHint").hide();
            }
        }
        if (res[i].status == 2) {//如果已出锅，但还在未出锅里，则删除
            o = $("#jxz").find('#ul' + res[i].id).html();
            if (o != undefined) {
                setTimeout("hideOrderList(" + res[i].id + ")", 2000);//更新移动该元素
            }
        }
    }
    layer.close(index);
}

function showDetail(res) {
    var order = res.order;
    var detail = res.detail;
    var i, text = "", len = detail.length;
    $("#detail_info").html("");
    for (i = 0; i < len; i++) {
        text = '<dl class="clearfix">';
        text += '<dt><h5>' + detail[i].name + '</h5>';
        if ((detail[i].type) != null)
            text += '<span>' + detail[i].type + '</span>';
        text += '</dt><dd><span class="amount_box">X' + detail[i].num + '</span><span class="price_box">￥' + (detail[i].price / 100) + '</span></dd></dl>';
        $("#detail_info").append(text);
    }
    $("#ddid").html("订单ID：" + order.id);
    $("#xdr").html("下单人：" + order.realname);
    $("#lxdh").html("联系电话：" + order.phone);
    $("#jczh").html("就餐桌号：" + order.table);
    if (order.status == 2) status = "已完成"; else status = "进行中";
    $("#ddzt").html("订单状态：" + status);
    $("#xdsj").html("下单时间：" + order.created_time);
    $("#bz").html("订单备注：" + order.text);
    $("#conf").attr("onClick", 'printOrder(' + order.id + ")");
}

function hideOrderList(id) {
    var parent = $("#ul" + id);
    $(parent).slideUp(800, function () {
        var html = $(parent).html() + $("#ywc").html();//转到隔壁
        $("#ywc").html(html);
        $(this).remove();
    })
}

function detail(table, orderId) {
    getOrderDetail(orderId);
    var index = layer.open({
        type: 1,
        title: "桌号：" + table,
        fixed: true,
        content: $("#detail")
    });
    layer.full(index);
}
function woaicssq(num) {
    for (var id = 1; id <= 2; id++) {
        var MrJin = "woaicss_con" + id;
        if (id == num)
            document.getElementById(MrJin).style.display = "block";
        else
            document.getElementById(MrJin).style.display = "none";
    }
    var zzsc = $(".Chikafusa a");
    zzsc.click(function () {
        $(this).addClass("thisclass").siblings().removeClass("thisclass");
    });
}
$(function () {
    var zzsc = $(".Chikafusa a");
    zzsc.click(function () {
        $(this).addClass("thisclass").siblings().removeClass("thisclass");
    });
});
var orders = [];
var firstOpen = 0, page = 0;
var bigId = 0; //用来排序订单

function getOrderList(status, page) {//拉取订单
    $.ajax({
        url: 'http://ms.n39.cn/food/api/get-order-list?status=' + status + '&page=' + page + '&' + addUrl,
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

function searchOrder() {//搜索订单
    var id = $("#order_id").val();
    $("#sou").html("");
    if (id.length > 0) {
        $.ajax({
            url: 'http://ms.n39.cn/food/api/get-order-list?id=' + id + '&' + addUrl,
            dataType: 'jsonp',
            data: '',
            jsonp: 'callback',
            timeout: 5000,
            success: function (res) {
                res = res.data;
                searchList(res);
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
}

function getOrderPage() {    //加载更多
    page++;
    getOrderList(1, page);
    getOrderList(2, page);
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

function confirmCheckOrder(id) {
    var name = $("#ul" + id + " h4").html();
    layer.confirm('<' + name + '>', {
        title: '是否标记订单完成',
        closeBtn: 0,
        btn: ['完成', '否'] //按钮

    }, function () {
        layer.msg('提交成功', {icon: 1});
        checkOrder(id, 2);
    }, function () {
    });
}

function checkOrder(order_id, status) {//出锅、传菜状态更新
    var index = layer.load(0, {shade: false});
    $.ajax({
        url: 'http://ms.n39.cn/food/api/check-order?order_id=' + order_id + '&status=' + status + "&" + addUrl,
        dataType: 'jsonp',
        data: '',
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            res = res.data;
            setTimeout("hideOrderList(" + order_id + ")", 2000);//提交后删除该元素
            layer.close(index);
            layer.close(detailIndex);
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

function printOrder(order_id) {//打印订单
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

function showList(res, status) {//显示订单
    var i, text = "", divname = "", len = res.length;
    var o;
    if (len == 0 && status == 1) $("#jxzHint").show();
    if (len == 0 && status == 2) $("#ywcHint").show();
    for (i = 0; i < len; i++) {
        if (orders.indexOf(res[i].id) == -1) {
            orders.push(res[i].id);

            //if(res[i].id<smallId || smallId==0) smallId=res[i].id;

            text = '<div id="ul' + res[i].id + '"><ul><li class="clearfix"><h4>订单ID：' + res[i].id + '</h4>';
            text += '<span class="unpaid_box" style="color:#00A75A; border:1px solid #00A75A;" onClick="printOrder(' + res[i].id + ')">打印</span>';
            text += '<span class="unpaid_box" style="color:#3C8DBD; border:1px solid #3C8DBD; margin:0 5px; " onClick="detail(' + "'" + res[i].table + "'," + res[i].id + ')">查看</span></li>';
            text += '<li class="clearfix" style="border:none;margin-bottom:-10px;"><h4>桌号：' + res[i].table + '</h4><span class="consume_box">￥' + res[i].total + '</span></li>';
            text += '<li class="clearfix"><h4 class="time_box">下单时间：' + res[i].created_time + '</h4><span style="color:#A0A3A5; font-size:14px;">' + res[i].people + '人就餐</span></li>';
            if ((res[i].text).length > 0)
                text += '<div class="hint_box"><img src="images/tishi.png" width="15" height="15"/>' + res[i].text + '</div>';
            text += '</ul><div class="blank_box"></div></div>';

            if (status == 1)
                divname = "#jxz";
            if (status == 2)
                divname = "#ywc";
            if (firstOpen >= 2 && res[i].id > bigId)//如果是后面请求的新订单，加入前头
                $(divname).prepend(text);
            else
                $(divname).append(text);

            if (res[i].id > bigId || bigId == 0) bigId = res[i].id;
            $(divname + "Hint").hide();
        }
        if (res[i].status == 2) {//如果已出锅，但还在未出锅里，则删除
            o = $("#jxz").find('#ul' + res[i].id).html();
            if (o != undefined) {
                setTimeout("hideOrderList(" + res[i].id + ")", 2000);//更新移动该元素
            }
        }
    }
    layer.close(index);
    firstOpen++;
}

function searchList(res) { //显示搜索的订单
    var i, text = "", len = res.length;
    $("#woaicss_con1").hide();
    $("#woaicss_con2").hide();
    $("#woaicss_con3").show();
    $(".Chikafusa a").siblings().removeClass("thisclass");
    $("#souHint").show();
    for (i = 0; i < len; i++) {

        text = '<div id="ul' + res[i].id + '"><ul><li class="clearfix"><h4>订单ID：' + res[i].id + '</h4>';
        text += '<span class="unpaid_box" style="color:#00A75A; border:1px solid #00A75A;" onClick="printOrder(' + res[i].id + ')">打印</span>';
        text += '<span class="unpaid_box" style="color:#3C8DBD; border:1px solid #3C8DBD; margin:0 5px; " onClick="detail(' + "'" + res[i].table + "'," + res[i].id + ')">查看</span></li>';
        text += '<li class="clearfix" style="border:none;margin-bottom:-10px;"><h4>桌号：' + res[i].table + '</h4><span class="consume_box">￥' + res[i].total + '</span></li>';
        text += '<li class="clearfix"><h4 class="time_box">下单时间：' + res[i].created_time + '</h4><span style="color:#A0A3A5; font-size:14px;">' + res[i].people + '人就餐</span></li>';
        if ((res[i].text).length > 0)
            text += '<div class="hint_box"><img src="images/tishi.png" width="15" height="15"/>' + res[i].text + '</div>';
        text += '</ul><div class="blank_box"></div></div>';

        $("#sou").append(text);
        $("#souHint").hide();
    }
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
        text += '</dt><dd><span class="amount_box">X' + detail[i].num + '</span><span class="price_box" onclick="refund(' + detail[i].id + ',' + (detail[i].price / 100) + ')">￥' + (detail[i].price / 100) + '</span></dd></dl>';
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
    $("#finish").attr("onClick", 'confirmCheckOrder(' + order.id + ")");
}

function refund(order_info_id, total_fee) {
    layer.prompt({title: '输要退款的金额,最大(' + total_fee + ')', value: total_fee, formType: 0}, function (fee, index) {
        layer.close(index);
        if (/^\d+(\.\d{1,2})?$/.test(fee)) {
            fee = fee * 1;
            if (fee > total_fee) return layer.msg('不能超过' + total_fee);
            if (fee <= 0) return layer.msg('必须大于0');
            $.ajax({
                url: 'http://ms.n39.cn/food/api/refund?order_info_id=' + order_info_id + '&fee=' + fee + '&' + addUrl,
                dataType: 'jsonp',
                data: '',
                jsonp: 'callback',
                timeout: 5000,
                success: function (res) {
                    res = res.data;
                    layer.close(index);
                    if (res.result_code == 'SUCCESS') {
                        layer.msg('发起退款成功！', {icon: 1});
                    } else
                        layer.msg(res.err_code_des, {icon: 2});
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
        } else {
            layer.msg('输入不规范');
        }
    });
}

function hideOrderList(id) {
    var parent = $("#ul" + id);
    $(parent).slideUp(800, function () {
        $("#ywc").prepend("<ul>" + $(this).html() + "</ul>");//转到隔壁
        $(this).remove();
    })
}

var detailIndex;

function detail(table, orderId) {
    getOrderDetail(orderId);
    detailIndex = layer.open({
        type: 1,
        title: "桌号：" + table,
        fixed: true,
        content: $("#detail")
    });
    layer.full(detailIndex);
}

function woaicssq(num) {
    for (var id = 1; id <= 3; id++) {
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
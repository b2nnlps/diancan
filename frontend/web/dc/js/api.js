/*
 API公共库
 */
var username, hash, device_id, addUrl, newMess = false, firstOpen = 0;
var orders = [];

username = getQueryString("username");
hash = getQueryString("hash");
device_id = getQueryString("device_id");
addUrl = "username=" + username + "&hash=" + hash + "&device_id=" + device_id;

function ccdl(res, status) {
    firstOpen++;
    var i, text = "", len = res.length;
    var dingDong = false;
    for (i = 0; i < len; i++) {
        if (orders.indexOf(res[i].id) == -1) {
            orders.push(res[i].id);
            newMess = true;
            text += "<ul id=\"ul" + res[i].id + "\">";
            text += "<h4>桌号：" + res[i].table + "桌</h4>";
            text += "<div><span>" + res[i].food_name + "</span>X" + res[i].num + "</div>";
            text += "<li>" + res[i].updated_time + "</li>";
            if (res[i].text.length > 0)
                text += "<p>" + '<img src="images/tishi.png" width="15" height="15">' + res[i].text + "</p>";
            text += "<div class=\"pot_box\">";
            if (status == 1) //只有未传菜有信息时才响
                text += "<input type=\"checkbox\" id=\"checkbox_d" + res[i].id + "\" class=\"chk_4\" onclick=\"chuanCai(" + res[i].id + ")\"/><label for=\"checkbox_d" + res[i].id + "\"></label>";

            text += "</div>";
            if (status == 2 && (res[i].operator) != null) //如果是已传菜，且有操作人
                text += '<div class="my_center"><img src="icon/grimg.png"><i>' + res[i].operator + '</i></div>';
            text += "</ul>";
        }
        if (res[i].status == 2) {//如果已传菜，但还在未传菜，则删除
            o = $("#dcc").find('#ul' + res[i].id).html();
            if (o != undefined) {
                hideChuanCaiOrder(res[i].id, res[i].operator);//更新移动该元素
            }
        }

    }
    if (newMess) {
        console.log("新消息");
        if (status == 1) {
            $("#dcc").append(text);
            dingDong = true;
        }
        if (status == 2)
            $("#ycc").append(text);
        if (firstOpen > 1 && dingDong)
            playSound();
    } else console.log("无消息");
    newMess = false;

}
function cfdl(res, status) {//出锅界面
    var i, text = "", len = res.length;
    var o;
    var dingDong = false;
    firstOpen++;
    for (i = 0; i < len; i++) {
        if (orders.indexOf(res[i].id) == -1) {
            orders.push(res[i].id);
            newMess = true;
            text += "<ul id=\"ul" + res[i].id + "\">";
            text += "<div class=\"clearfix\"><em>" + res[i].food_name + "</em><span>X" + res[i].num + "</span></div>";
            text += "<li>桌号" + res[i].table + "</li>";
            text += "<li>" + res[i].updated_time + "</li>";
            if (res[i].text.length > 0)
                text += "<p>" + '<img src="images/tishi.png" width="15" height="15">' + res[i].text + "</p>";
            text += "<div class=\"pot_box\">";
            if (status == 0)
                text += "<input type=\"checkbox\" id=\"checkbox_d" + res[i].id + "\" class=\"chk_4\" onclick=\"chuGuo(" + res[i].id + ")\" /><label for=\"checkbox_d" + res[i].id + "\"></label>";
            //if(status==1)

            text += "</div>";
            text += "</ul>";
        }
        if (res[i].status == 1) {//如果已出锅，但还在未出锅里，则删除
            o = $("#wcg").find('#ul' + res[i].id).html();
            if (o != undefined) {
                hideChuGuoOrder(res[i].id);//更新移动该元素
            }
        }
        if (res[i].status == 2) {//如果已传菜，但还在已出锅里，则删除
            o = $("#ycg").find('#ul' + res[i].id).html();
            if (o != undefined) {
                $("#ul" + res[i].id).remove();
            }
        }
    }

    console.log(firstOpen + " " + dingDong);
    if (newMess) {
        console.log(status + " 新消息");
        if (status == 0)//只有未出锅有信息时才响
        {
            dingDong = true;
            $("#wcg").append(text);
        }
        if (status == 1) {
            $("#ycg").append(text);
        }
        if (firstOpen > 2 && dingDong)
            playSound();
    } else console.log("无消息");
    newMess = false;
}

function chuGuo(id) {
    var name = $("#ul" + id).find("em").html();
    layer.confirm('<' + name + '>', {
        title: '出锅确认',
        closeBtn: 0,
        btn: ['出锅', '否'] //按钮
    }, function () {
        layer.msg('提交成功', {icon: 1});
        $("#checkbox_d" + id).attr('disabled', 'disabled');
        checkOrder(id, 1);
    }, function () {
        $("#checkbox_d" + id).attr('checked', false);
    });
}

function hideChuGuoOrder(id) {
    var parent = $("#ul" + id);
    $(parent).slideUp(800, function () {
        $(parent).find("label").remove();
        var html = "<ul id=\"ul" + id + "\">" + $(parent).html() + "</ul>" + $("#ycg").html();//转到隔壁
        $("#ycg").html(html);
        $(this).remove();
    })
}

function chuanCai(id) {
    var name = $("#ul" + id).find("span").html();
    layer.confirm('<' + name + '>', {
        title: '传菜确认',
        closeBtn: 0,
        btn: ['传菜', '否'] //按钮

    }, function () {
        layer.msg('提交成功', {icon: 1});
        $("#checkbox_d" + id).attr('disabled', 'disabled');
        checkOrder(id, 2);
    }, function () {
        $("#checkbox_d" + id).attr('checked', false);
    });
}

function hideChuanCaiOrder(id, operator) {
    var parent = $("#ul" + id);
    var ycc = $("#ycc");
    $(parent).slideUp(800, function () {
        $(parent).find("label").remove();
        $(parent).append('<div class="my_center"><img src="icon/grimg.png"><i>' + operator + '</i></div>');
        var html = "<ul>" + $(parent).html() + "</ul>" + $(ycc).html();//转到隔壁头部
        $(ycc).html(html);
        $(this).remove();//删除未传菜里面的信息
        if ($(ycc).children('ul').length > 50) {//如果已传菜超过了50个，则删除后面的
            var i = 0;
            $("#ycc ul").each(function () {
                i++;
                if (i > 50) $(this).remove();
            })
        }
    })
}

function getOrder(type, status, sort) {//获取订单信息 type 0厨房 1传菜员 排序方式
    // 获取信息
    $.ajax({
        url: 'http://ms.n39.cn/food/api/get-wait-order?status=' + status + "&sort=" + sort + "&" + addUrl,
        dataType: 'jsonp',
        data: '',
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            res = res.data;
            //  console.log(res);
            layer.close(index);

            if (type == 0)
                cfdl(res, status);
            if (type == 1)
                ccdl(res, status);

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

function checkOrder(info_id, status) {//出锅、传菜状态更新
    var index = layer.load(0, {shade: false});
    $.ajax({
        url: 'http://ms.n39.cn/food/api/check-order?info_id=' + info_id + '&status=' + status + "&" + addUrl,
        dataType: 'jsonp',
        data: '',
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            res = res.data;
            if (status == 1)
                setTimeout("hideChuGuoOrder(" + info_id + ",'我自己')", 2000);//提交后删除该元素
            if (status == 2)
                setTimeout("hideChuanCaiOrder(" + info_id + ",'我自己')", 2000);//提交后删除该元素
            layer.close(index);
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

function getUserInfo() {//获取店和店员信息
    $.ajax({
        url: 'http://ms.n39.cn/food/api/user-info?' + addUrl,
        dataType: 'jsonp',
        data: '',
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            res = res.data;
            shop = res.shop;
            if (shop != undefined) {
                $("#shopImg").attr("src", shop.img);
                $("#shopName").text(shop.name);
                $("#shopDescription").text(shop.description);
                $("#ddck").attr("href", $("#ddck").attr("href") + addUrl);
                $("#cfdd").attr("href", $("#cfdd").attr("href") + addUrl);
                $("#ccdd").attr("href", $("#ccdd").attr("href") + addUrl);
                $("#zxfk").attr("href", $("#zxfk").attr("href") + addUrl);
            } else {
                $("#shopImg").attr("src", "images/rh_logo.png");
                $("#shopName").text("容合软件");
                $("#shopDescription").text("专门针对中小型商家而制作专业的点餐系统.");
            }

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

function playSound()//播放提示音
{
    //非IE内核浏览器
    var strAudio = "<audio id='audioPlay' src='audio/dingdong.mp3' hidden='true'>";
    if ($("body").find("audio").length <= 0)
        $("body").append(strAudio);
    var audio = document.getElementById("audioPlay");
    //浏览器支持 audion
    audio.play();
}

function getQueryString(name) { //获取get传过来的用户信息
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null;
} 
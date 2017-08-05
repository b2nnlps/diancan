/*
 本文件为获取商品API使用
 */
var shop, classes, food, foodInfo = [];

function showFoodList(res) {
    var i, text = "", text2 = "";
    shop = res.shop;
    classes = res.classes;
    food = res.food;
    //=====处理商家信息=====//
    if (shop == null) {
        $("#shop_img").attr("src", "/static/84dc/images/rh_logo.png");
        $("#shop_name").html("容合智能点餐");
        $("#shop_description").html("欢迎使用");
        layer.msg('该商家没有开通点餐哦~', {icon: 0, time: 60000});
    }
    $("#shop_name").html(shop.name);
    $("#shop_img").attr("src", shop.img);
    $("#shop_description").html(shop.description);

    //=====处理分类======//
    len = classes.length;
    for (i = 0; i < len; i++) {
        text += '<div class="li"><a href="#list_title' + classes[i].id + '">' + classes[i].name + '</a></div>';//侧边栏的分类
        text2 += '<div class="list_cont"><div class="list_tile" id="list_title' + classes[i].id + '">' + classes[i].name + '</div><div class="list_right" id="body' + classes[i].id + '"></div></div>';//主体的分类
    }
    //侧边栏分类
    text += '<div style=" padding-bottom:300px;"></div>';
    $(".list_menu").html(text);
    $(".list_menu>:first").addClass('on');	//第一个分类标红
    //主体分类
    $(".list_box").html(text2);

    //=====处理规格数据=====//
    var Info = res.foodInfo;
    len = Info.length;
    for (i = 0; i < len; i++) {
        if (foodInfo[Info[i].food_id] == undefined) {
            a = [];
            a.push(Info[i]);
            foodInfo[Info[i].food_id] = a;
        } else {
            a = foodInfo[Info[i].food_id];
            a.push(Info[i]);
            foodInfo[Info[i].food_id] = a;
        }
    }
    console.log(foodInfo);
    //处理结果foodInfo的键值为food_id，内容为规格的对象
    //=====处理显示菜品=====//
    len = food.length;
    for (i = 0; i < len; i++) {
        text = '<div class="right_list clearfix">';
        text += '<div class="list_img"><a onclick="openDetail(' + food[i].id + ')"><img src="' + food[i].head_img + '"></a></div>';
        text += '<div class="nopic_box1">';
        text += '<p><a onclick="openDetail(' + food[i].id + ')">' + food[i].name + '</a></p>';
        a = getInfoPrice(food[i].id);
        text += '<div>已售' + food[i].sold_number + '份</div><div><b>￥' + a[1] + '</b></div>';
        if (food[i].status == 0 && a[1] != "售完") {
            if (a[0] == true)//是否有多个规格
                text += '<div class="plus"><a data-id="' + food[i].id + '">选规格</a></div></div></div>';
            else {
                var info = foodInfo[food[i].id];//查找规格
                text += '<div class="btn_v1" data-id="' + food[i].id + '" data-name="' + food[i].name + '" data-price="' + a[1] + '">';
                text += '<button class="index_minus"><strong></strong></button>';
                text += '<li id="info_num' + info[0].id + '">0</li>';//第一个规格的ID
                text += '<button class="index_add"><strong></strong></button>';
                text += '</div></div>';
            }
        }
        if (food[i].status == 1 || a[1] == "售完")
            text += '<div class="but">售完</div>';
        $("#body" + food[i].class_id).append(text);
    }
    updateIndex(false);//更新首页的商品数量
}


function getInfoPrice(id) {//自动转化规格价格到主体
    var low = 99999, high = 0, a = [];
    info = foodInfo[id];
    if (info == undefined) {
        a[0] = false;
        a[1] = '售完';
        return a;
    }

    for (i = 0; i < info.length; i++) {
        if (info[i].price > high) high = info[i].price;
        if (info[i].price < low) low = info[i].price;
    }
    if (info.length == 1) {//是否有多个规格
        a[0] = false;
        a[1] = high;
    } else {
        a[0] = true;
        a[1] = low + "-" + high;
    }
    return a;
}

function getFoodList(shopId) {//获取菜品信息
    // 获取信息
    $.ajax({
        url: 'http://ms.n39.cn/food/api/get-food-list?shopId=' + shopId,
        dataType: 'jsonp',
        data: '',
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            res = res.data;
            console.log(res);
            layer.close(index);
            showFoodList(res);

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

function updateIndex(del) { //更新首页的商品数量
    var data = $.cookie('cart');
    var total_num = 0, total_price = 0;
    if (data) {
        data = JSON.parse(data);
        for (var x = 0; x < 999; x++) {
            if (data.cart[x] == undefined)break;
            if (data.cart[x].num <= 0 || del) {
                $("#info_num" + data.cart[x].id).css("display", "none").prev().css("display", "none");
            } else {
                $("#info_num" + data.cart[x].id).html(data.cart[x].num).parent().children().css("display", "inline-block");
                total_num += data.cart[x].num;
                total_price += data.cart[x].num * data.cart[x].price;
            }
        }
        $("#totalcountshow").html(total_num);
        $("#totalpriceshow").html((total_price).toFixed(2));//计算当前所选总价
    }
}

function updateCart() {	//更新购物车的商品数量
    var data = $.cookie('cart');
    var text = "", total_num = 0, total_price = 0;
    if (data) {
        data = JSON.parse(data);
        for (var x = 0; x < 999; x++) {
            if (data.cart[x] == undefined)break;
            if (data.cart[x].num <= 0)continue;
            text += '<dl class="clearfix" data-id="' + data.cart[x].id + '"><dt>' + data.cart[x].name + '</dt><dd>￥' + data.cart[x].price + '</dd>';
            text += '<div class="btn_v2">';
            text += '<button class="cart_minus"><strong></strong></button>';
            text += '<i>' + data.cart[x].num + '</i>';
            text += '<button class="cart_add"><strong></strong>';
            text += '</button></div></dl>';
            total_num += data.cart[x].num;
            total_price += data.cart[x].num * data.cart[x].price;
        }
        $(".cart_box").html(text);
        $("#totalcountshow").html(total_num);
        $("#totalpriceshow").html((total_price).toFixed(2));//计算当前所选总价
    }
}
function countTotal() {//计算总数,总价
    var data = $.cookie('cart');
    var total_num = 0, total_price = 0;
    if (data) {
        data = JSON.parse(data);
        for (var x = 0; x < 999; x++) {
            if (data.cart[x] == undefined)break;
            if (data.cart[x].num <= 0)continue;
            total_num += data.cart[x].num;
            total_price += data.cart[x].num * data.cart[x].price;
        }
        $("#totalcountshow").html(total_num);
        $("#totalpriceshow").html((total_price).toFixed(2));//计算当前所选总价
    }
}

function updateCookie(id, num, price, name, text) {	//输入商品id,数量，价格即可
    var has = false;
    var data = $.cookie('cart');
    if (data) {
        data = JSON.parse(data);
        for (var x = 0; x < 999; x++) {
            if (data.cart[x] == undefined)break;
            if (data.cart[x].id == id) {
                data.cart[x].num += parseInt(num);//修改数量
                if (text.length > 0)
                    data.cart[x].text = text;//修改备注
                has = true;
            }
        }
        data = JSON.stringify(data);
    }
    if (!has && data == null) {
        data = '{\"cart\":[{\"id\":' + id + ',\"num\":' + num + ',\"price\":' + price + ',\"name\":\"' + name + '\",\"text\":\"' + text + '\"}]}';
    } else {
        if (!has) {
            temp = ',{\"id\":' + id + ',\"num\":' + num + ',\"price\":' + price + ',\"name\":\"' + name + '\",\"text\":\"' + text + '\"}]}';  //从后面插入位移两位
            data = data.replace("]}", temp);
        }
    }
    $.cookie('cart', data, {expires: 1, path: '/'});
    countTotal();
    updateIndex(false);//更新首页
}
function deleteCart() {
    layer.confirm('是否清空购物车？', {
        btn: ['是', '否'] //按钮
    }, function () {
        updateIndex(true);//清空首页
        $.cookie('cart', null, {expires: 0, path: '/'});
        $("#totalcountshow").html(0);
        $("#totalpriceshow").html("0.00");//计算当前所选总价
        $('.pop_box').hide();
        $('#fade').hide();

        layer.msg('清空成功', {icon: 1});
    }, function () {
    });
}

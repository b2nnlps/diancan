/*
 本文件为获取商品API使用
 */
var shop, classes, food, foodInfo = [];

function showFoodList(res) {
    var i, text = "", text2 = "";
    shop = res.shop;
    classes = res.classes;
    food = res.food;


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
        text = '<dl data-name="' + food[i].name + '"><dt><a><img class="lazy" data-original="' + food[i].head_img + '" alt="只"></a></dt>';
        text += '<dd><h3><a>' + food[i].name + '</a></h3>';
        text += '<span>销售量：' + food[i].sold_number + '只</span><span>库存:<em class="stock">' + food[i].sold_number + '</em>只</span>';
        a = getInfoPrice(food[i].id);
        text += '<h5>￥<em class="price">' + a[1] + a[2] + '</em></h5></dd>';
        text += '<div class="clear"></div><div class="alterdiv"><a href="update.html?food_id=' + food[i].id + '&' + addUrl + '"><img src="icon/bj.png"></a></div></dl>';

        $(".gl_list").append(text);
    }
    $("img.lazy").lazyload({threshold: 180});
}


function getInfoPrice(id) {//自动转化规格价格到主体
    var low = 99999, high = 0, a = [];
    info = foodInfo[id];
    if (info == undefined) {
        a[0] = false;
        a[1] = '售完';
        a[2] = '';
        return a;
    }

    for (i = 0; i < info.length; i++) {
        if ((info[i].price) * 1 > high) high = (info[i].price) * 1;
        if ((info[i].price) * 1 < low) low = (info[i].price) * 1;
    }
    if (info.length == 1) {//是否有多个规格
        a[0] = false;
        a[1] = high;
        a[2] = "/" + info[0].unit;
    } else {
        a[0] = true;
        a[1] = low + "-" + high;
        a[2] = '';
    }
    return a;
}

function getFoodList() {//获取菜品信息
    // 获取信息
    $.ajax({
        url: 'http://dev.ms.n39.cn/food/api/admin-food-list?' + addUrl,
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

function search() {
    var name = $("#searchName").val();
    var myname;
    if (name.length == 0)
        $(".gl_list dl").show();
    else
        $(".gl_list dl").each(function () {
            myname = $(this).data("name");
            if (myname.indexOf(name) == -1) $(this).hide(); else $(this).show();
        });
}

/*
 本文件为获取商品API使用
 */
var shop, classes, food, foodInfo = [];

food_id = getQueryString("food_id");

function AdminFoodView() {//获取菜品信息
    // 获取信息
    $.ajax({
        url: 'http://dev.ms.n39.cn/food/api/admin-food-view?food_id=' + food_id + "&" + addUrl,
        dataType: 'jsonp',
        data: '',
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            res = res.data;
            console.log(res);
            showFood(res);
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

function showFood(res) {
    var i, j, total_store = 0;
    var food = res.food;
    var info = res.foodInfo;
    var classes = res.classes;
    var text = "", text2 = "";
    for (i = 0; i < info.length; i++) {
        if (info[i].title == null) info[i].title = '标准';
        text += '<div class="standard_centre" id="gg_box_' + i + '"><dl class="clearfix"><dt>规格' + (i + 1) + '：</dt>';
        text += '<dd><input name="info_id[' + i + ']" type="hidden" value="' + info[i].id + '"><input name="info_title[' + i + ']" placeholder="可输入颜色，大小，尺寸" type="text" value="' + info[i].title + '" ></dd></dl>';
        text += '<dl class="clearfix"><dt>价格：</dt><dd><input name="info_price[' + i + ']"  placeholder="零售价格" type="text" value="' + info[i].price + '"></dd></dl>';
        text += '<dl class="clearfix"><dt>单位：</dt><dd><input name="info_unit[' + i + ']"   placeholder="商品单位" type="text" value="' + info[i].unit + '"></dd></dl>';
        text += '<dl class="clearfix"><dt>库存：</dt><dd><input name="info_number[' + i + ']" placeholder="真实库存" type="text" value="' + info[i].number + '"></dd></dl>';
        text += '<div class="delete_box" onclick="del(' + i + ')"><img src="icon/scimg.png"></div></div>';
        total_store += info[i].number * 1;
    }
    for (j = 0; j < classes.length; j++) {
        text2 += '<option value="' + classes[j].id + '">' + classes[j].name + '</option>';
    }
    $("#gg_box").html(text);//填入规格
    $("#food_class").html(text2);//填入分类
    $("#food_name").val(food.name);
    $("#food_store").html(total_store);
    $("#food_status").val(food.status);
    $("#food_class").val(food.class_id);
    info_i = i;
}

function updateInfo() {
    var str_data = $("form input").map(function () {
        return ($(this).attr("name") + '=' + $(this).val());
    }).get().join("&");//拼接INPUT表单
    str_data += '&food[id]=' + food_id + '&food[name]=' + $("#food_name").val() + '&food[class_id]=' + $("#food_class").val() + '&food[status]=' + $("#food_status").val();
    $.ajax({
        url: 'http://dev.ms.n39.cn/food/api/admin-food-update?' + addUrl,
        dataType: 'jsonp',
        data: str_data,
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            if (res.code == 403) {
                console.log(res);
                layer.alert(res.message, {
                    icon: 5
                });
            } else {
                res = res.data;
                console.log(res);
                layer.msg("保存成功");
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
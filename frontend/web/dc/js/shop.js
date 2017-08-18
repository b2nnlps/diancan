function getShop() {//获取店铺信息
    $.ajax({
        url: 'http://ms.n39.cn/food/api/user-info?' + addUrl,
        dataType: 'jsonp',
        data: '',
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            res = res.data;
            console.log(res);
            shop = res.shop;
            $("#name").val(shop.name);
            $("#address").val(shop.address);
            $("#contact").val(shop.contact);
            $("#description").val(shop.description);

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

function updateShop() {
    var str = 'Shop[name]=' + $("#name").val() + '&Shop[address]=' + $("#address").val() + '&Shop[contact]=' + $("#contact").val() + '&Shop[description]=' + $("#description").val();
    $.ajax({
        url: 'http://ms.n39.cn/food/api/admin-shop-setting?' + addUrl,
        dataType: 'jsonp',
        data: str,
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            console.log(res);
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
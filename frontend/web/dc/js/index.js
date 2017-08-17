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
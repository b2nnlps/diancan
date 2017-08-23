function loginUser(username, password) {
    var hash = hex_md5(username + "llrj" + password);
    var addUrl = "username=" + username + "&hash=" + hash + "&device_id=null";
    $.ajax({
        url: 'http://ms.n39.cn/food/api/user-info?' + addUrl,
        dataType: 'jsonp',
        data: "",
        jsonp: 'callback',
        timeout: 5000,
        success: function (res) {
            console.log(res);
            if (res.code == -100) {
                console.log(res);
                layer.alert("登录失败，请检查用户名和密码.", {
                    icon: 5
                });
                layer.close(index);
            } else {
                res = res.data;
                console.log(res);
                layer.msg("登录成功,如需打印请设置打印机.");
                // window.location.href = 'http://ms.n39.cn/dc/index.html?' + addUrl;
                window.wx.JsMoveToIndex(username, password);//调用系统函数
            }
        },
        error: function () {
            console.log('登录失败');
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
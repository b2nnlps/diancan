/**
 * ת������
 * @returns {undefined}
 */
var debug_t = false;
var wx_config_t = {
    debug: debug_t,
    appId: appId,
    timestamp: timestamp,
    nonceStr: nonceStr,
    signature: signature,
    jsApiList: [
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo'
    ]
};
wx.config(wx_config_t);
var onBridgeReady_new;
wx.ready(function () {
    onBridgeReady_new = function () {
        console.log(4444444444);
        wx.onMenuShareAppMessage({
            title: dataForShare.title,
            desc: dataForShare.description,
            link: dataForShare.weixin_url,
            imgUrl: dataForShare.weixin_icon,
            //   trigger: function (res) {_shareInWeixin._hideFromJsBridge();/*alert('�û�������͸�����');*/},
            success: function (res) {
                //    (dataForShare.callback)();
                //alert("лл���ķ���");
            },
            cancel: function (res) {/*alert('��ȡ��');*/
            },
            fail: function (res) {
                //alert(JSON.stringify(res));
            }
        });
        wx.onMenuShareTimeline({
            title: dataForShare.description,
            link: dataForShare.weixin_url,
            imgUrl: dataForShare.weixin_icon,
            //    trigger: function (res) {_shareInWeixin._hideFromJsBridge();/*alert('�û������������Ȧ');*/},
            success: function (res) {
                // (dataForShare.callback)();

            },
            cancel: function (res) {/*alert('��ȡ��');*/
            },
            fail: function (res) {
                //alert(JSON.stringify(res));
            }
        });
        wx.onMenuShareQQ({
            title: dataForShare.title,
            desc: dataForShare.description,
            link: dataForShare.weixin_url,
            imgUrl: dataForShare.weixin_icon,
            // trigger: function (res) {_shareInWeixin._hideFromJsBridge();},
            complete: function (res) {
                //alert(JSON.stringify(res));
            },
            //  success: function (res) {(dataForShare.callback)();},
            cancel: function (res) {/*alert('��ȡ��');*/
            },
            fail: function (res) {
                //alert(JSON.stringify(res));
            }
        });
        wx.onMenuShareWeibo({
            title: dataForShare.title,
            desc: dataForShare.description,
            link: dataForShare.weixin_url,
            imgUrl: dataForShare.weixin_icon,
            //  trigger: function (res) {_shareInWeixin._hideFromJsBridge();/*alert('�û��������΢��');*/},
            complete: function (res) {
                //alert(JSON.stringify(res));
            },
            //   success: function (res) {(dataForShare.callback)();},
            cancel: function (res) {/*alert('��ȡ��');*/
            },
            fail: function (res) {
                //alert(JSON.stringify(res));
            }
        });
    }
    onBridgeReady_new();
});

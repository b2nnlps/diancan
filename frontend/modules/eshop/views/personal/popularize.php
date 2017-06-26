<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-08
 * Time: 10:55
 */
use backend\modules\sys\models\WechatUser;

$jssdk = new \common\wechat\JSSDK();
$signPackage = $jssdk->GetSignPackage();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= Yii::$app->params['eshop']?></title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/font1/xiaogan.css" rel="stylesheet" type="text/css">
    <script>
        /**
         * 转发封面及简介
         * @returns {undefined}
         */
        var uid="<?=$user_id?>";
        var dataForShare={
            weixin_icon:"http://msjlb.n39.cn/img/logo.png",
            weixin_url:"http://msjlb.n39.cn/eshop/default/invite?uid="+uid,
            weibo_icon:"http://msjlb.n39.cn/img/logo.png",
            url:"http://msjlb.n39.cn/eshop/default/invite?uid="+uid,
            title:"美食俱乐部",
            description:"<?=WechatUser::getNickname($user_id)?>邀您到美食俱乐部享受优惠啦"
        };
    </script>
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
            <p>二维码邀请</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <!----->
    <div class="bust_part">
        <dl>
            <dt><img src="<?=WechatUser::getHeadimgurl($user_id)?>"></dt>
            <dd>
                <h5><?=WechatUser::getNickname($user_id)?></h5>
                <cite></cite><cite></cite> </dd>
            <div class="clear"></div>
        </dl>
    </div>
    <!--微信邀请家人--->
    <div class="WeChat">
        <h5>微信邀请会员</h5>
        <img src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=<?=$QRImg?>">
        <p>使用说明：点击右上角三个点(...)，然后在弹出菜单中，选择发送给朋友或分享到朋友圈，您的朋友即可通过扫描分享的二维码海报接受您邀请！</p>
    </div>
</div>
</body>
</html>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    /**
     * 转发调用
     * @returns {undefined}
     */
    var  debug_t=false;
    var wx_config_t={
        debug: debug_t,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
        ]
    };
    wx.config(wx_config_t);
    var onBridgeReady_new;
    wx.ready(function (){
        onBridgeReady_new=function(){
            wx.onMenuShareAppMessage({
                title: dataForShare.title,
                desc: dataForShare.description,
                link: dataForShare.weixin_url,
                imgUrl: dataForShare.weixin_icon,
                //   trigger: function (res) {_shareInWeixin._hideFromJsBridge();/*alert('用户点击发送给朋友');*/},
                success: function (res) {
                    //    (dataForShare.callback)();
                    //alert("谢谢您的分享。");
                },
                cancel: function (res) {/*alert('已取消');*/},
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });
            wx.onMenuShareTimeline({
                title: dataForShare.description,
                link: dataForShare.weixin_url,
                imgUrl: dataForShare.weixin_icon,
                //    trigger: function (res) {_shareInWeixin._hideFromJsBridge();/*alert('用户点击分享到朋友圈');*/},
                success: function (res) {
                    // (dataForShare.callback)();

                },
                cancel: function (res) {/*alert('已取消');*/},
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
                cancel: function (res) {/*alert('已取消');*/},
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });
            wx.onMenuShareWeibo({
                title: dataForShare.title,
                desc: dataForShare.description,
                link: dataForShare.weixin_url,
                imgUrl: dataForShare.weixin_icon,
                //  trigger: function (res) {_shareInWeixin._hideFromJsBridge();/*alert('用户点击分享到微博');*/},
                complete: function (res) {
                    //alert(JSON.stringify(res));
                },
                //   success: function (res) {(dataForShare.callback)();},
                cancel: function (res) {/*alert('已取消');*/},
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });
        }
        onBridgeReady_new();
    });
</script>

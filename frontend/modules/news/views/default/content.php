<?php

$jssdk = new \common\wechat\JSSDK();
$signPackage = $jssdk->GetSignPackage();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>美食俱乐部</title>
    <script>
        /**
         * 转发封面及简介
         * @returns {undefined}
         */
        var dataForShare={
            weixin_icon:"<?=$news['img']?>",
            weixin_url:"<?= Yii::$app->urlManager->createAbsoluteUrl(['news/default/content','id'=>$news['id']]) ?>",
            weibo_icon:"<?=$news['img']?>",
            url:"<?= Yii::$app->urlManager->createAbsoluteUrl(['news/default/content','id'=>$news['id']]) ?>",
            title:"<?=$news['title']?>",
            description:"<?=$news['intro']?>"
        };
    </script>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="head"><img src="<?=$news['img']?>"></div>
    <div class="headlinebox">
        <h4><?=$news['title']?></h4>
        <div class="timebox">
            <time><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/record.png" width="20" height="20"><?=date('Y-m-d',strtotime($news['created_time']))?></time>
            <span><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/browse.png" width="20" height="20"><?=$news['pv']?></span>
        </div>
    </div>
    <div class="compilebox">
        <?=$news['content']?>
    </div>
    <div class="footer">
        <a href="http://mp.weixin.qq.com/mp/homepage?__biz=MzA3NTc1NzM5OQ==&hid=1&sn=d45bf00f0e7d3905f8898bf6914aac18&uin=MjI5ODI2OTg2MQ%3D%3D&key=c3acc508db720376d6cbca6d5f7813f4b38abff3145557000d3611adabefe34e2eb4e4cd3a120f18f486327b6760ed99&devicetype=android-23&version=26031b31&lang=zh_CN&nettype=WIFI&wx_header=1&scene=1">
            容合
            <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/logo.png" width="20" height="20"/>
            美食
        </a>
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
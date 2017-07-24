<?php

$jssdk = new \common\wechat\JSSDK();
$signPackage = $jssdk->GetSignPackage();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合活动吧</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/style.css" rel="stylesheet" type="text/css">
    <script>
        /**
         * 转发封面及简介
         * @returns {undefined}
         */
        var dataForShare={
            weixin_icon:"<?=$applyActivity['imgurl']?>",
            weixin_url:"<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/apply','aid'=>$applyActivity['id']]) ?>",
            weibo_icon:"<?=$applyActivity['imgurl']?>",
            url:"<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/apply','aid'=>$applyActivity['id']]) ?>",
            title:"<?=$applyActivity['send_title']?>",
            description:"<?=$applyActivity['send_detail']?>"
        };
    </script>
</head>

<body>
<div class="box">
    <div class="head"><img src="<?=$applyActivity['imgurl']?>"></div>
    <div class="headlinebox">
        <h4><?=$applyActivity['title']?></h4>
        <div class="timebox">
            <time><?=date('Y-m-d',strtotime($applyActivity['created_time']))?></time>
            <span><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/browse.png" width="20" height="20"><?=$applyActivity['pv']?></span>
        </div>
    </div>

    <div class="sponsor">
        <ul>
            <li>
                <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/time.png" width="20">
                   <?=date('Y-m-d H:i',strtotime($applyActivity['start_time']))?> 至 <?=date('Y-m-d H:i',strtotime($applyActivity['end_time']))?>
            </li>
            <li class="address">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/map1.png" width="20">
                <?=\common\models\ComModel::cut_str($applyActivity['address'],33)?>
            </li>
            <li>
                <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/personage1.png" width="20">
                已报名 <?=$number?>人/限 <?=$applyActivity['restrict']?>人报名
            </li>
            <li style="border:none; color:#F39D12;">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/money.png" width="20">
                <?php
                $charge=$applyActivity['charge'];
                if($charge!=""){
                    echo $charge;
                }else{
                    echo '免费';
                } ?>
            </li>
        </ul>
        <dl class="clearfix">
            <a href="#">
                <dt><img src="<?=$applyActivity['hedimg']?>"></dt>
                <dd>
                    <h5><?=$applyActivity['initiator']?></h5>
                    <span><?=$applyActivity['intro']?></span>
                </dd>
            </a>
        </dl>
        <div class="attbox clearfix">
            <a style="border-right:1px solid #E0DFDF" href="<?=$applyActivity['url']?>">+关注</a>
            <a href="tel:<?=$applyActivity['phone']?>">联系Ta</a>
        </div>
    </div>
    <div style=" width:100%; height:10px; background-color:#ECF0F3;"></div>



    <div class="compilebox">
        <?=$applyActivity['content']?>
    </div>
    <div class="footer">
        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/about']) ?>">
            容合
            <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/logo.png" width="20" height="20"/>
            活动吧
        </a>
    </div>
    <div class="apply">
        <dl class="clearfix">
            <dt class="clearfix">
                <a style=" border-right:1px solid  #E4E4E4;" href="tel:<?=$applyActivity['phone']?>">
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/consult.png" width="25" height="25">
                    咨询
                </a>
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/applyrecord','aid'=>$applyActivity['id']]) ?>">
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/recor.png" width="25" height="25">
                    报名记录
                </a>
            </dt>
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/apply/attend','aid'=>$applyActivity['id']]) ?>">
                <dd><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/apply.png" width="25" height="25">我要报名</dd>
            </a>
        </dl>
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
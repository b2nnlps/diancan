<?php
use backend\modules\eshop\models\Product;
use backend\modules\eshop\models\Category;
use backend\modules\sys\models\Link;
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
        var dataForShare={
            weixin_icon:"http://ms.n39.cn/img/logo.png",
            weixin_url:"http://ms.n39.cn/eshop/good/index",
            weibo_icon:"http://ms.n39.cn/img/logo.png",
            url:"http://ms.n39.cn/eshop/good/index",
            title:"<?= Yii::$app->params['eshop']?>",
            description:"欢迎您注册容合订单管理系统，此系统完全免费。"
        };
    </script>
</head>

<body>
<div class="box">

        <!--图片转播-->
        <div id="demo01" class="flexslider">
            <ul class="slides">
                <?php
                $ad_link=Link::find()->where(['c_id'=>1])->limit(5)->orderBy('sort desc')->all();
                foreach ($ad_link as $_v){
                ?>
                <li>
                    <div class="img"><a href="<?=$_v['url']?>"><img src="<?=$_v['img']?>" alt="<?=$_v['title']?>" /></a></div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!--flexslider end-->

    <div class="business">
        <ul>
            <?php
            $nav_link=Link::find()->where(['c_id'=>2,'status'=>1])->limit(8)->orderBy('sort desc')->all();
            foreach ($nav_link as $_v){
                ?>
                <li>
                    <a href="<?=$_v['url']?>">
                        <img src="<?=$_v['img']?>" alt="<?=$_v['title']?>">
                        <h3><?=$_v['title']?></h3>
                    </a>
                </li>
            <?php } ?>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="backgroundxx"></div>
    <div id="woaicss_con1" style="display:block;">
        <?php foreach ($sumpplier as $_k=>$_v){?>
                <div class="pecifics">
                    <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['eshop/good/product-list', 'sump_id' => $_v['id']]) ?>">
                        <ul>
                            <li><img src="<?= $_v['ad_img'] ?>"></li>
                            <li>
                                <ins class="icon-55"></ins><?= $_v['labels'] ?>
                                <ins class="icon-30"></ins><?= $_v['views'] ?></li>
                        </ul>
                    </a>
                </div>
<!--         --><?php
//        $product=Product::find()->where(['supplier_id'=>$_v['id']])->limit(2)->orderBy('id desc')->all();
//        foreach ($product as $_v){
//        ?>
<!--        <div class="listx">-->
<!--            <a href="--><?//=Yii::$app->urlManager->createAbsoluteUrl(['eshop/good/commodity','id'=>$_v['id']])?><!--">-->
<!--                <dl>-->
<!--                    <dt><img src="--><?//=$_v['thumb']?><!--" alt="--><?//=$_v['name']?><!--"></dt>-->
<!--                    <dd>-->
<!--                        <h3>--><?//=$_v['name']?><!--</h3>-->
<!--                        <span><img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/eshop/icon/jg.png" width="18" height="18">--><?//=$_v['price']?><!--</span>-->
<!--                        <span><img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/eshop/icon/fl.png" width="18" height="18"><em>--><?//=Category::getParent($_v['category_id'])?><!--</em></span>-->
<!--                        <span><img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/eshop/icon/pv.png" width="18" height="18"><em>--><?//=$_v['pv']?><!--</em></span>-->
<!--                    </dd>-->
<!--                    <div class="clear"></div>-->
<!--                </dl>-->
<!--            </a>-->
<!--        </div>-->
<!--        --><?php //} ?>
        <?php } ?>
    </div>

    <div class="personage"><a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/index'])?>"><ins class="icon-5"></ins><p>个人中心</p></a></div>
</div>
<script src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/slider.js"></script>
<script type="text/javascript">
    $(function(){
        $('#demo01').flexslider({
            animation: "slide",
            direction:"horizontal",
            easing:"swing"
        });

        $('#demo02').flexslider({
            animation: "slide",
            direction:"vertical",
            easing:"swing"
        });

    });
</script>
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
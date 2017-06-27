<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 20:40
 */
use backend\modules\sys\models\WechatUser;


$sdasd=$model['sdasd'];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/user.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png" width="30" height="30"></a></li>
            <p>个人中心</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <header>
            <dl>
                <dt> <img src="<?=WechatUser::getHeadimgurl($wx_openid)?>"></dt>
                <dd>
                    <h4><?=WechatUser::getNickname($wx_openid)?></h4>
                    <p><?=$sdasd?$sdasd:'人生的际遇，在于无形的发现！';?></p>
                </dd>
                <div class="clear"></div>
            </dl>
        </header>
        <!--个人中心：开始-->
        <div class="personalCenter">
            <!--个人信息-->
            <div class="recharge_box">
                <div class="recharge clearfix">
                    <a class="kf" href="#"><span><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/jj.png">代金券</span></a>
                    |
                    <a class="kf" href="#"><span><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/qd.png">签到</span></a>
                </div>
            </div>
            <!--功能列表-->
            <ul>
<!--                <a href="--><?//=Yii::$app->urlManager->createAbsoluteUrl(['merchant/good/product-list','sid'=>1])?><!--">-->
<!--                    <li><img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/merchant_v1.0/icon/sy.png"><em>商城首页</em></li>-->
<!--                </a>-->
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/details','rh_openid'=>$rh_openid])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/zl.png"><em>个人资料</em></li>
                </a>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/order-list'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/dd.png"><em>我的订单</em></li>
                </a>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/address'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/dz.png"><em>收货地址</em></li>
                </a>
                <div id="fgdiv"></div>

                <?php
                if($rank<3){
                    $supplier=\backend\modules\merchant\models\Supplier::find()->where(['rh_openid'=>$rh_openid])->one();
                    $supplierID=$supplier['id'];
                ?>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/wdgl','sid'=>$supplierID])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/wd.png"><em>微店管理</em></li>
                </a>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/index'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/wdd.png"><em>微店订单</em></li>
                </a>

                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/product-gl'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/cpimg.png"><em>商品管理</em></li>
                </a>
                  <?php if($rank==1){?>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/user-list'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/hyimg.png"><em>会员管理</em></li>
                </a>
                    <?php } ?>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/generalize'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/tg5.png"><em>微店推广</em></li>
                </a>
                <a class="kf" href="#">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/ewm.png"><em>推广二维码</em></li>
                </a>
                
                <div id="fgdiv"></div>
                <?php } ?>
                <a class="kf" href="#">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/zn.png"><em>使用指南</em></li>
                </a>
                <a class="kf" href="#">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/xs.png"><em>新手任务</em></li>
                </a>
                <a class="kf" href="#">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/xx.png"><em>我的消息</em></li>
                </a>
                <a class="kf" href="#">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/kf.png"><em>客服中心</em></li>
                </a>

            </ul>
        </div>
        <!--个人中心：结束-->
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>
<script  type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery.hDialog.js"></script>
<script>
    $(function(){
        //正确文字提示
        $('.kf').click(function(){
            $.tooltip('正在开发中，敬请期待。。。', 2500, true);
        });
    });
</script>
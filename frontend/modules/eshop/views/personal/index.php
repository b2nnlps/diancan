<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 20:40
 */
use backend\modules\sys\models\WechatUser;

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= Yii::$app->params['eshop']?></title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/font1/xiaogan.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
            <p>个人中心</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <header>
            <dl>
                <dt> <img src="<?=WechatUser::getHeadimgurl($user_id)?>"></dt>
                <dd>
                    <h4><?=WechatUser::getNickname($user_id)?></h4>
                    <p>欢迎您的惠顾!</p>
                </dd>
                <div class="clear"></div>
            </dl>
        </header>
        <!--个人中心：开始-->
        <div class="personalCenter">
            <!--个人信息-->
            <div class="recharge clearfix">
                <a href="#"><span><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/tu1.png">代金券</span></a>
                |
                <a href="#"><span><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/tu2.png">签到</span></a>
            </div>
            <!--功能列表-->
            <ul>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/good/index'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/home.png"><em>商城首页</em></li>
                </a>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/index'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/tu3.png"><em>我的订单</em></li>
                </a>
                <?php
                if(count($member)==0){
                ?>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/add'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/grzl.png"><em>完善资料</em></li>
                </a>
                <?php }else{?>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/details'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/grzl.png"><em>个人资料</em></li>
                </a>
                <?php }?>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/address'])?>">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/tu6.png"><em>收货地址</em></li>
                </a>
               <!--                <a href="--><?//=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/popularize'])?><!--">-->
<!--                    <li><img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/eshop/images/tgcode.png"><em>推广二维码</em></li>-->
<!--                </a>-->
                 <?php
                if($rank!=1){
                    ?>
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/order-list'])?>">
                        <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/tu4.png"><em>代理中心</em></li>
                    </a>
                <?php }?>
				 <?php
                if($rank!=1){
                    ?>
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/clearing-list'])?>">
                        <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/clearing.png"><em>结算中心</em></li>
                    </a>
                <?php }?>
                <a href="#">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/tu5.png"><em>使用指南</em></li>
                </a>

                <a href="#">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/tu7.png"><em>新手任务</em></li>
                </a>
                <a href="#">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/tu8.png"><em>我的消息</em></li>
                </a>
                <a href="#">
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/tu9.png"><em>客服中心</em></li>
                </a>
            </ul>
        </div>
        <!--个人中心：结束-->
    </div>
</div>
</body>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 21:01
 */
use backend\modules\sys\models\District;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= Yii::$app->params['eshop']?></title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/qqq.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/font1/xiaogan.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
            <p>个人资料</p>
            <li id="save" style=" font-size:14px; color:#FF4A83; "></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="cellphone">
            <span>联系人</span>
            <em><?=$member['realname']?></em>
        </div>
        <div class="cellphone">
            <span>手机号码</span>
            <em><?=$member['phone']?></em>
        </div>
        <div class="cellphone">
            <span>地址详情</span>
            <em><?=$member['address']?></em>
        </div>

    </div>
</div>
</body>
</html>

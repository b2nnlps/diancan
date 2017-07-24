<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;


?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈-报名管理</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/fontico.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="succeed">
        <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/jg.png" width="80px">
        <p style=" font-size: 20px; color: #9f191f; margin-top: 20px;margin-bottom: 50px;">您不是管理员，没相关权限！</p>
    </div>
    <div style="width:100%; margin-bottom:50px; margin-top: -20px;">
        <div style="width:50%; float: left; text-align: center;">
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/apply','aid'=>$aid]) ?>"> <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/home.png" width="30">返回首页</a>
        </div>
        <div style="width:49%; float: right; text-align: center;">
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/apply/adminlist','aid'=>$aid]) ?>"><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/gr.png" width="30">申请为管理员</a>
        </div>
    </div>
    <div class="footer" style="margin-bottom:-50px;">
        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/about']) ?>">
            容合
            <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/logo.png" width="20" height="20"/>
            微商圈
        </a>
    </div>
</div>
</body>
</html>


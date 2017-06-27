<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-17
 * Time: 10:21
 */

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <META http-equiv=refresh content="2;URL =<?=Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/list'])?>">
    <title>容合活动吧</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/fontico.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul class="clearfix">
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/return.png" width="20" height="20"></a></li>
            <p>报名成功</p>
            <li></li>
        </ul>
    </div>
    <div class="succeed"><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/images/confirmation.png"><p>报名成功</p></div>

    <div class="footer" style="margin-bottom:-50px;"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/about']) ?>">容合<img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/logo.png" width="20" height="20"/>活动吧</a></div>
</div>
</body>
</html>


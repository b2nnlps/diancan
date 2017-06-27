<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合微商圈</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/fontico.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="succeed">
        <img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/ts.png" width="80px">
        <p style=" font-size: 16px; color: #9f191f; margin-top: 2px;margin-bottom: 5px;"> <?= Html::encode($this->title) ?></p>
        <p style=" font-size: 20px; color: #9f191f; margin-top: 20px;margin-bottom: 50px;"> <?= nl2br(Html::encode($message)) ?></p>
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


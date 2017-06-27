<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-17
 * Time: 10:34
 */
use backend\modules\activitys\models\ApplyAttend;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>报名详情</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/fontico.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul class="clearfix">
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/return.png" width="20" height="20"></a></li>
            <p>报名详情</p>
            <li></li>
        </ul>
    </div>
    <div class="particularsbox">
        <dl class="clearfix">
            <dt>姓 名：</dt>
            <dd><?=$applyAttend['name']?></dd>
        </dl>
        <dl class="clearfix">
            <dt>手 机：</dt>
            <dd><?=$applyAttend['phone']?></dd>
        </dl>
        <dl class="clearfix">
            <dt>人 数：</dt>
          <dd><?=$applyAttend['number']?>人</dd>
        </dl>
        <dl class="clearfix">
            <dt>状 态：</dt>
            <dd><?=ApplyAttend::status($applyAttend['status'])?></dd>
        </dl>
        <dl class="clearfix">
            <dt>时 间：</dt>
            <dd><?=$applyAttend['created_time']?></dd>
        </dl>
        <dl class="clearfix">
            <dt>备 注：</dt>
            <dd><?=$applyAttend['remark']?></dd>
        </dl>
    </div>
    <div class="footer"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/about']) ?>">容合<img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/logo.png" width="20" height="20"/>活动吧</a></div>
</div>
</body>
</html>


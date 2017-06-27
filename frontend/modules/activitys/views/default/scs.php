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
    <title>联系方式</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/fontico.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul class="clearfix">
            <li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/apply','aid'=>1]) ?>"><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/home.png" width="20" height="20"></a></li>
            <p>提交审核</p>
            <li></li>
        </ul>
    </div>
    <div class="succeed"><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/images/confirmation.png">
        <p>提交成功</p>
        <p style=" padding: 10px; font-size: 16px; color: #189DE1;">请等待超级管理员审核！</p>
    </div>
    <div class="contact">
        <h4>您也可以联系以下已经通过的管理员进行审核：</h4>
        <ul>
            <?php
            $applyAudit=\backend\modules\activitys\models\ApplyAudit::find()->where(['status'=>2])->all();
            foreach($applyAudit as $_V){
            ?>
            <li class="clearfix">
                <span><?=$_V['name']?> 微信号:<?=$_V['wx_number']?></span>
                <a href="tel:<?=$_V['phone']?>">手机号：<?=$_V['phone']?></a></li>
            <?php } ?>

        </ul>
    </div>
    <div class="footer" style="margin-bottom:-50px;"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/about']) ?>">容合<img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/logo.png" width="20" height="20"/>活动吧</a></div>
</div>
</body>
</html>


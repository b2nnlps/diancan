<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 20:56
 */

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= Yii::$app->params['eshop']?></title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/font1/xiaogan.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/jquery.spinner.js"></script>
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
            <p>选择地址</p>
            <li style=" font-size:14px;">
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/add-region'])?>">新增</a>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="selectaddress">
            <?php foreach ($address as $_v){?>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/update-region','id'=>$_v['id']])?>">
                <ul>
                    <li class="colour">
                        <?=$_v['consignee']?>  <span><?=$_v['phone']?> </span>
                    </li>
                    <li>
                        <?=$_v['address']?>
                    </li>
                        <img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/bj.png">
                </ul>
                </a>
            <?php }?>
        </div>
    </div>
</div>
</body>
</html>


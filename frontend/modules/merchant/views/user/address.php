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
            <p>地址列表</p>
            <li style=" font-size:14px;">
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/add-region'])?>">新增</a>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="selectaddress">

            <?php
            foreach ($model as $_v){
            ?>
            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/update-region','id'=>$_v['id']])?>">
                <ul>
                    <li class="colour">
                        <?=$_v['consignee']?>  <span> <?=$_v['phone']?> </span>
                    </li>
                    <li>
                        <?=$_v['address']?>
                    </li>
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/bj.png">
                </ul>
            </a>
            <?php }?>
        </div>
		 <?php if($sid!=0){?>
        <div class="fhdiv"><a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/cart','sid'=>$sid])?>">返回购物车</a></div>
        <?php }?>
    </div>
</div>
</body>
</html>



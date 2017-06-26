<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 20:48
 */
use backend\modules\eshop\models\Orderproduct;
use backend\modules\eshop\models\Order;
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
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
            <p>订单列表</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="indent">
            <?php
            foreach ($order as $_v){
                $status=$_v['status'];
                if($status==1){
                    $statusColor='#F39D12';
                }elseif ($status==2){
                    $statusColor='#3C8DBD';
                }elseif ($status==3){
                    $statusColor='#00C1EF';
                }elseif ($status==4){
                    $statusColor='#00A75A';
                }elseif ($status==5){
                    $statusColor='#DD4A38';
                }
                
                $total=0;
                $numbers=0;
                $orderproduct=Orderproduct::find()->where(['order_id'=>$_v['id']])->asArray()->all();
                foreach ($orderproduct as $val){
                    $number=$val['number'];
                    $price=$val['price'];
                    $subtotal=$number*$price;//小计
                    $numbers += $number;
                    $total += $subtotal;
                 } ?>
            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/order-detail','order_id'=>$_v['id']])?>">
                <dl>
<!--                    <dt> <img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/eshop/images/88.png" alt="动态图片"></dt>-->
                    <dd>
                        <h3>订单编号：<?=$_v['sn']?></h3>
<!--                        <h5>煲仔饭等4件商品煲仔饭等4件商品</h5>-->
                        <h5>下单时间：<?=$_v['created_time']?><h5>
                                <h4>数量：<span><?=$numbers?></span>实付<span>￥<?=$total?></span><em style="background-color:<?=$statusColor?>;"><?=Order::status($status)?></em></h4>
                    </dd>
                    <div class="clear"></div>
                </dl>
            </a>
            <?php }?>
        </div>
    </div>
</div>
<!--<script type="text/javascript">-->
<!--    $('.spinnerExample').spinner({});-->
<!--</script>-->
</body>
</html>


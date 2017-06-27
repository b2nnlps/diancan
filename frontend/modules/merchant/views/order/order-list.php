<?php
use backend\modules\merchant\models\Orderproduct;
use backend\modules\merchant\models\Member;
use backend\modules\merchant\models\Order;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/shop.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png"></a></li>
            <p>订单列表</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="seek_box">
            <div class="seek clearfix">
                <input type="text" placeholder="请输入您查询的订单号">
                <a href="#"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/ssimg.png"></a>
            </div>
        </div>
        <div class="Chika">
            <div class="Chikafusa">
                <a href="javascript:void(-1);" onClick="woaicssq(1)" id="woaicsstitle" class="thisclass">未成交</a>
                <a href="javascript:void(-1);" onClick="woaicssq(2)" id="woaicsstitle" >已成交</a>
            </div>
        </div>
        <div id="woaicss_con1" style="display:block;">

            <div class="indent">

                <?php
                foreach ($order as $_v){
                    $payment_status=$_v['payment_status'];
                    $shipment_status=$_v['shipment_status'];
                    if($payment_status==1&&$shipment_status==1){
                        $statusColor='#F39D12';
                        $statusVa='待接单';
                    }elseif ($payment_status==1&&$shipment_status==2){
                        $statusColor='#3C8DBD';
                        $statusVa='未付款';
                    }elseif ($payment_status==2&&$shipment_status==1){
                        $statusColor='#00C1EF';
                        $statusVa='未取货';
                    }elseif ($payment_status==2&&$shipment_status==2){
                        $statusColor='#00A75A';
                        $statusVa='已成交';
                    }else{
                        $statusColor='#DD4A38';
                        $statusVa='已取消';
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
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/order-detail','order_id'=>$_v['id']])?>">
                    <dl>
                        <dd>
                            <h3>订单编号：<?=$_v['sn']?></h3>
                            <h5>下单人：<?=Member::getMemberName($_v['rh_openid'])?></h5>
                            <h5>下单时间：<?=$_v['created_time']?></h5>
							<h5>取货时间：<?=$_v['receive_time']?></h5>
                            <h4>数量：<span><?=$numbers?></span>实付<span>￥<?=$total?></span><em style="background-color:<?=$statusColor?>;"><?=$statusVa?></em></h4>
                        </dd>
                        <div class="clear"></div>
                    </dl>
                </a>
                <?php }?>

            </div>

        </div>
        <!---->
        <div id="woaicss_con2" style="display:none;">
            <div class="indent">
                <?php
                $order=Order::find()->where(['rh_openid'=>$rh_openid,'payment_status'=>2,'shipment_status'=>2])->asArray()->orderBy('id desc')->all();
                foreach ($order as $_v){
                    $payment_status=$_v['payment_status'];
                    $shipment_status=$_v['shipment_status'];
                    if($payment_status==1&&$shipment_status==1){
                        $statusColor='#F39D12';
                        $statusVa='待接单';
                    }elseif ($payment_status==1&&$shipment_status==2){
                        $statusColor='#3C8DBD';
                        $statusVa='未付款';
                    }elseif ($payment_status==2&&$shipment_status==1){
                        $statusColor='#00C1EF';
                        $statusVa='未取货';
                    }elseif ($payment_status==2&&$shipment_status==2){
                        $statusColor='#00A75A';
                        $statusVa='已成交';
                    }else{
                        $statusColor='#DD4A38';
                        $statusVa='已取消';
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
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/order-detail','order_id'=>$_v['id']])?>">
                        <dl>
                            <dd>
                                <h3>订单编号：<?=$_v['sn']?></h3>
                                <h5>下单人：<?=Member::getMemberName($_v['rh_openid'])?></h5>
                                <h5>下单时间：<?=$_v['created_time']?></h5>
								<h5>取货时间：<?=$_v['receive_time']?></h5>
                                <h4>数量：<span><?=$numbers?></span>实付<span>￥<?=$total?></span><em style="background-color:<?=$statusColor?>;"><?=$statusVa?></em></h4>
                            </dd>
                            <div class="clear"></div>
                        </dl>
                    </a>
                <?php }?>

            </div>


        </div>

    </div>
</div>

</body>
</html>
<script src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/js/jquery-1.9.1.min.js"></script>
<script language="javascript">
    function woaicssq(num){
        for(var id = 1;id<=2;id++)
        {
            var MrJin="woaicss_con"+id;
            if(id==num)
                document.getElementById(MrJin).style.display="block";
            else
                document.getElementById(MrJin).style.display="none";
        }
        var zzsc = $(".Chikafusa a");
        zzsc.click(function(){
            $(this).addClass("thisclass").siblings().removeClass("thisclass");
        });
    }
    $(function(){
        var zzsc = $(".Chikafusa a");
        zzsc.click(function(){
            $(this).addClass("thisclass").siblings().removeClass("thisclass");
        });
    });
</script>

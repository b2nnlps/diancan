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
            <p>代理订单</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">

        <div class="Chika">
            <div class="Chikafusa">
                <a href="#" onclick="woaicssq(1)" id="woaicsstitle" class="thisclass">未成交</a>
                <a href="#" onclick="woaicssq(2)" id="woaicsstitle" >已成交</a>
            </div>
        </div>
        <div id="woaicss_con1" style="display:block;">

            <div class="indent">
            <?php
            //  $order=Order::find()->where(['!=','status',4])->asArray()->orderBy('id desc')->all();
            $connection=Yii::$app->db;
            $mess_array= array('oV1VUt0U0HE0F5T3sCry_LGaFuSA','oV1VUt7WZf6Ruscht-AonBlIZBQk','oV1VUtxN7VeqSpovbaYIfHX3Ymg0','oV1VUt6RUheAI-xfveukXdNW2ak8','oV1VUt5ctZOiWicBSV6hoWl0XHr0','oV1VUt0-rX8Xcr_J-ZV5EqqQM_1c','oV1VUtxKZmChxJNkTjaOPS1n3kiw');
           // $mess=array_unique($mess_array);
            $isin = in_array($user_id,$mess_array);//php判断数组元素中是否存在某个字符串的方法in_array(value,array,type)
            if($isin){//存在
                $sql="select * from t_eshop_order where status<>4 order by id desc";
            }else{//不存在
                $sql="select * from t_eshop_order where status<>4 AND (user_id='$user_id' OR referrer='$user_id') order by id desc";
            }

            $command=$connection->createCommand($sql);
            $order=$command->queryAll();
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
				  $supplier_id=$val['supplier_id'];
                 } ?>
            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/order-detail','order_id'=>$_v['id']])?>">
                <dl>
<!--                    <dt> <img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/eshop/images/88.png" alt="动态图片"></dt>-->
                    <dd>
                        <h3>订单编号：<?=$_v['sn']?></h3>
						  <h5><?=\backend\modules\eshop\models\Sumpplier::getName($supplier_id)?></h5>	
                        <h5>下单时间：<?=$_v['created_time']?><h5>
                                <h4>数量：<span><?=$numbers?></span>实付<span>￥<?=$total?></span><em style="background-color:<?=$statusColor?>;"><?=Order::status($status)?></em></h4>
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
                // $order=Order::find()->where(['status'=>4])->asArray()->orderBy('id desc')->all();
                $connection=Yii::$app->db;
                $mess_array= array('oV1VUt0U0HE0F5T3sCry_LGaFuSA','oV1VUt7WZf6Ruscht-AonBlIZBQk','oV1VUtxN7VeqSpovbaYIfHX3Ymg0','oV1VUt6RUheAI-xfveukXdNW2ak8','oV1VUt5ctZOiWicBSV6hoWl0XHr0','oV1VUt0-rX8Xcr_J-ZV5EqqQM_1c','oV1VUtxKZmChxJNkTjaOPS1n3kiw');
               // $mess=array_unique($mess_array);
                $isin = in_array($user_id,$mess_array);//php判断数组元素中是否存在某个字符串的方法in_array(value,array,type)
                if($isin){//存在
                    $sql="select * from t_eshop_order where status=4 order by id desc";
                }else{//不存在
                    $sql="select * from t_eshop_order where status=4 AND (user_id='$user_id' OR referrer='$user_id') order by id desc";
                }
                $command=$connection->createCommand($sql);
                $order=$command->queryAll();
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
						  $supplier_id=$val['supplier_id'];
                    } ?>
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/order-detail','order_id'=>$_v['id']])?>">
                        <dl>
                            <!--                    <dt> <img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/eshop/images/88.png" alt="动态图片"></dt>-->
                            <dd>
                                <h3>订单编号：<?=$_v['sn']?></h3>
								  <h5><?=\backend\modules\eshop\models\Sumpplier::getName($supplier_id)?></h5>		
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
</div>
<!--<script type="text/javascript">-->
<!--    $('.spinnerExample').spinner({});-->
<!--</script>-->
</body>
</html>
<script src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/jquery.min.js"></script>
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

<?php
use backend\modules\merchant\models\Order;
use backend\modules\merchant\models\Member;
use backend\modules\merchant\models\Orderstatus;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <?= \yii\helpers\Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/shop.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/user_xz.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box" style=" background:#F4F6F5"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png" width="30" height="30"></a></li>
            <p>订单详情</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="Chika">
            <div class="Chikafusa">
                <a href="javascript:void(-1);" onClick="woaicssq(1)" id="woaicsstitle" class="thisclass">订单详情</a>
                <a href="javascript:void(-1);" onClick="woaicssq(2)" id="woaicsstitle" class="">订单状态</a>
            </div>
        </div>

        <div id="woaicss_con1" style="display:block;">
            <div class="pecifics">
                <div class="details">
                    <h4>订购商品</h4>

                    <?php
                    $total = 0;
                    $numbers=0;
                    foreach ($orderproduct as $_v){
                        $number=$_v['number'];
                        $price=$_v['price'];
                        $subtotal=$number*$price;//小计
                        $numbers += $number;
                        $total += $subtotal;
                        ?>
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/good/commodity','aid'=>$_v['product_id']])?>">
                            <dl>
                                <dt><?=$_v['name']?></dt>
                                <dd><span>￥<?=$price?></span>  <span>x<?=$number?></span> </dd>
                                <div class="clear"></div>
                            </dl>
                        </a>
                    <?php }?>


                </div>
                <div class="Amount">
                    <dl>
                        <dt>数量：<?=$numbers?> </dt>
                        <dd>总计<span>￥<?=$total?></span></dd>
                        <div class="clear"></div>
                    </dl>
                </div>
                <div class="delivery">
                    <dl>
                        <dt>订单号：</dt>
                        <dd><?=$order['sn']?></dd>
                        <div class="clear"></div>
                    </dl>
                    <dl>
                        <dt>所属商家：</dt>
                        <dd><?=$supplier['name']?></dd>
                        <div class="clear"></div>
                    </dl>

                    <dl>
                        <dt>下单人：</dt>
                        <dd><?=Member::getMemberName($order['rh_openid'])?></dd>
                        <div class="clear"></div>
                    </dl>
                    <dl>
                        <dt>下单时间：</dt>
                        <dd><?=$order['created_time']?></dd>
                        <div class="clear"></div>
                    </dl>
                    <dl>
                        <dt>取货时间：</dt>
                        <dd><?=$order['receive_time']?></dd>
                        <div class="clear"></div>
                    </dl>
                    <dl>
                        <dt>收货信息：</dt>
                        <dd><?=$order['consignee']?>【<?=$order['phone']?>】<?=$order['address']?></dd>
                        <div class="clear"></div>
                    </dl>
                    <dl>
                        <dt>支付方式：</dt>
                        <dd><?=$order->method($order['payment_method'])?></dd>
                        <div class="clear"></div>
                    </dl>
                    <dl>
                        <dt>下单备注：</dt>
                        <dd><?=$order['remark']?$order['remark']:'暂无！'?></dd>
                        <div class="clear"></div>
                    </dl>

                    <?php
                    $payment_status=$order['payment_status'];//支付状态
                    $shipment_status=$order['shipment_status'];//取货状态
//                    $payment_status=1;//支付状态
//                    $shipment_status=2;//取货状态
                    if(($payment_status==1||$shipment_status==1)&&$inArray==1){
                        ?>
                        <dl>
                            <dt>支付状态：</dt>
                            <dd>
                                <?php
                                if($payment_status==1){
                                ?>
                                <div class="opt" id="opt1">
                                    <input class="magic-radio" type="radio" name="payment_status" id="p1" value="1"  <?php if($payment_status==1){echo 'checked'; }?>>
                                    <label for="p1">未付款</label>
                                </div>
                                <div class="opt" id="opt1">
                                    <input class="magic-radio" type="radio" name="payment_status" id="p2" value="2">
                                    <label for="p2">已付款</label>
                                </div>
                                <?php }else{ ?>
                                    <?=Order::payment_status($payment_status)?>
                                    <input style="display:none;" type="radio" name="payment_status"  value="3" checked>
                                <?php } ?>

                            </dd>
                            <div class="clear"></div>
                        </dl>

                        <dl>
                            <dt>是否取货：</dt>
                            <dd>
                            <?php
                            if($shipment_status==1){
                            ?>
                                <div class="opt" id="opt1">
                                    <input class="magic-radio" type="radio" name="shipment_status" id="sp1" value="1"  <?php if($shipment_status==1){echo 'checked'; }?>>
                                    <label for="sp1">未取货</label>
                                </div>
                                <div class="opt" id="opt1">
                                    <input class="magic-radio" type="radio" name="shipment_status" id="sp2" value="2" >
                                    <label for="sp2">已取货</label>
                                </div>

                            <?php }else{ ?>
                                <?=Order::shipment_status($shipment_status)?>
                                <input style="display:none;" type="radio" name="shipment_status"  value="3" checked>
                                <?php } ?>
                            </dd>
                            <div class="clear"></div>
                        </dl>
                    <dl>
                        <dt style=" padding-top:15px;">状态备注：</dt>
                        <dd><textarea id="remark" rows="3"></textarea></dd>
                        <div class="clear"></div>
                    </dl>
                    <div class="submit"><button id="conf">提交</button></div>
                    <?php }else{ ?>
                        <dl>
                            <dt>支付状态：</dt>
                            <dd>
                                <?=Order::payment_status($payment_status)?>
                            </dd>
                            <div class="clear"></div>
                        </dl>

                        <dl>
                            <dt>是否取货：</dt>
                            <dd>
                                <?=Order::shipment_status($shipment_status)?>
                            </dd>
                            <div class="clear"></div>
                        </dl>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <!---->
    <div id="woaicss_con2" style="display:none;">
        <div class="pecifics">

            <div class="tailAfter"> <cite></cite>
                <?php foreach ($orderStatus as $_k=>$_v){
                    if($_k==0){
                        ?>
                        <dl>
                            <em></em>
                            <dt class="signFor">【<?=Orderstatus::status($_v['status'])?>】<?=$_v['remark']?>&nbsp;&nbsp;[操作员：<a href="tel:<?=Member::getPhone($_v['rh_openid']);?>"><?=Member::getPhone($_v['rh_openid']);?></a>&nbsp;]</dt>
                            <dd><?=$_v['time']?></dd>
                        </dl>
                    <?php }else{?>
                        <dl>
                            <em></em>
                            <dt>【<?=Orderstatus::status($_v['status'])?>】<?=$_v['remark']?>&nbsp;&nbsp;[操作员：<a href="tel:<?=Member::getPhone($_v['rh_openid']);?>"><?=Member::getPhone($_v['rh_openid']);?></a>&nbsp;]</dt>
                            <dd><?=$_v['time']?></dd>
                        </dl>
                    <?php } }?>
            </div>
        </div>
        <!--货物详情：结束-->
    </div>
</div>


</body>
</html>

<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>

<script src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery.hDialog.js"></script>
<script>
    $(function(){
        var csrfName = $('meta[name=csrf-param]').prop('content');
        var crsfToken = $('meta[name=csrf-token]').prop('content');
        var orderid =<?=$order['id']?>;
        var supplier_id =<?=$supplier_id?>;
        var checkSubmitFlg = false;
        $('#conf').click(function() {       
            if (!checkSubmitFlg) {
             
                var remark = $('#remark');

                var Obj = document.getElementsByName("payment_status");
                for(i=0;i<Obj.length;i++){if(Obj[i].checked){break}}
                var payment_status=Obj[i].value;

                var shipmentVar= document.getElementsByName("shipment_status");
                for(j=0;j<shipmentVar.length;j++){if(shipmentVar[j].checked){break}}
                var shipment_status=shipmentVar[j].value;
                if(payment_status==1&&shipment_status==1){
                    $.tooltip('变更状态后才能提交...');
                }else if(payment_status==1&&shipment_status==3){
                    $.tooltip('还没变更付款状态，不能提交！'); $name.focus();
                }else if(payment_status==3&&shipment_status==1){
                    $.tooltip('还没变更提货状态，不能提交！'); $name.focus();
                }else{
                    var data = csrfName + '=' + crsfToken + "&orderid=" + orderid + "&remark=" + remark.val()+ "&supplier_id=" + supplier_id+ "&payment_status=" + payment_status + "&shipment_status=" + shipment_status;
//                    alert(data);
                    if (!checkSubmitFlg) {
                        checkSubmitFlg = true;// 第一次提交
                        $.post("<?=\yii\helpers\Url::to(['order-status'])?>", data, function (result) {
                            window.location.href ="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/order-detail','order_id'=>$order['id']])?>";
                        });
                    }
                }

                return true;
            } else {
                //重复提交
                $.tooltip('请勿重复提交！');
                return false;
            }
        });
    });
</script>
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


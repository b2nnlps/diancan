<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 20:52
 */
use backend\modules\eshop\models\Order;
use backend\modules\eshop\models\Orderstatus;
use backend\modules\sys\models\Member;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= Yii::$app->params['eshop']?></title>
    <?= \yii\helpers\Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/font1/xiaogan.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box" style=" background:#F4F6F5"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
            <p>订单详情</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="Chika">
            <div class="Chikafusa">
                <a href="#" onclick="woaicssq(1)" id="woaicsstitle" class="thisclass">订单详情</a>
                <a href="#" onclick="woaicssq(2)" id="woaicsstitle" >订单状态</a>
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
                 <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/good/commodity','id'=>$_v['product_id']])?>">
                        <dl>
                            <dt><?=$_v['name']?></dt>
                            <dd> <span>x<?=$number?></span> <span>￥<?=$subtotal?></span> </dd>
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
                    <dt>下单人：</dt>
                    <dd><?=\backend\modules\sys\models\Member::getMemberName($order['user_id'])?></dd>
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
                    <?php
                    $remark=$order['remark'];
                    if($remark!=''){
                        $remarks=$remark;
                    }else{
                        $remarks='暂无！';
                    } ?>
                    <dd><?=$remarks?></dd>
                    <div class="clear"></div>
                </dl>
                <dl>
                    <dt>当前状态：</dt>
                    <dd><?=$order->status($order['status'])?></dd>
                    <div class="clear"></div>
                </dl>

                <?php
                $status=$order['status'];
               if($status<4&&$inArray==1){
                ?>
                <dl>
                    <dt>订单状态：</dt>
                    <dd>
                        <select id='orderstatus'>
                            <?php
                            $array2 =['1'=>'待商家接单','2'=>'商家已接单','3'=>'订单已配送','4'=>'订单已成交','5'=>'订单已取消'];
                            foreach($array2 as $key=>$value) {
                                if($key>$status){
                                ?>
                                <option value="<?=$key?>"><?=$value?></option>
                            <?php }} ?>
                        </select>
                    </dd>
                    <div class="clear"></div>
                </dl>
                <dl>
                    <dt style=" padding-top:15px;">状态备注：</dt>
                    <dd><textarea id="remark" rows="3"></textarea></dd>
                    <div class="clear"></div>
                </dl>
                <div class="submit"><button id="conf">提交</button></div>
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
                            <dt class="signFor">【<?=Orderstatus::status($_v['status'])?>】<?=$_v['remark']?>&nbsp;&nbsp;[操作员：<a href="tel:<?=Member::getPhone($_v['user_id']);?>"><?=Member::getPhone($_v['user_id']);?></a>&nbsp;]</dt>
                            <dd><?=$_v['created_time']?></dd>
                        </dl>
                         <?php }else{?>
                        <dl>
                            <em></em>
             <dt>【<?=Orderstatus::status($_v['status'])?>】<?=$_v['remark']?>&nbsp;&nbsp;[操作员：<a href="tel:<?=Member::getPhone($_v['user_id']);?>"><?=Member::getPhone($_v['user_id']);?></a>&nbsp;]</dt>
                            <dd><?=$_v['created_time']?></dd>
                        </dl>
                        <?php } }?>
                    </div>
            </div>
            <!--货物详情：结束-->
        </div>
    </div>
</div>
</div>
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
</body>
</html>
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
                $.dialog('confirm', '提示', '现在更新订单状态吗？', 0, function () {
                    var orderstatus = document.getElementById("orderstatus").value;
                    var remark = $('#remark');
                    var data = csrfName + '=' + crsfToken + "&orderid=" + orderid + "&orderstatus=" + orderstatus + "&remark=" + remark.val()+ "&supplier_id=" + supplier_id;
                    //    alert(data);
                    if (!checkSubmitFlg) {
                        checkSubmitFlg = true;// 第一次提交
                        $.post("<?=\yii\helpers\Url::to(['order-status'])?>", data, function (result) {
                            window.location.href = result;
                        });
                    }
                });
                return true;
            } else {
                //重复提交
                $.tooltip('请勿重复提交！');
                return false;
            }
            
        });
    });
</script>



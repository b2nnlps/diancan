<?php

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <?= \yii\helpers\Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/shop.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/ipt.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>
    <script language="javascript">
        function show(a){
            if(a){$(".contentt").fadeOut(500);$(".fix_mask").fadeOut(500);}else{$(".contentt").fadeIn(500);$(".fix_mask").fadeIn(500);}
        }
    </script>

    <script src="<?=Yii::$app->request->baseUrl?>/merchant_v1.0/timejs/mobiscroll_002.js" type="text/javascript"></script>
    <script src="<?=Yii::$app->request->baseUrl?>/merchant_v1.0/timejs/mobiscroll_004.js" type="text/javascript"></script>
    <link href="<?=Yii::$app->request->baseUrl?>/merchant_v1.0/css/mobiscroll_002.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->request->baseUrl?>/merchant_v1.0/css/mobiscroll.css" rel="stylesheet" type="text/css">
    <script src="<?=Yii::$app->request->baseUrl?>/merchant_v1.0/timejs/mobiscroll.js" type="text/javascript"></script>
    <script src="<?=Yii::$app->request->baseUrl?>/merchant_v1.0/timejs/mobiscroll_003.js" type="text/javascript"></script>
    <script src="<?=Yii::$app->request->baseUrl?>/merchant_v1.0/timejs/mobiscroll_005.js" type="text/javascript"></script>
    <link href="<?=Yii::$app->request->baseUrl?>/merchant_v1.0/css/mobiscroll_003.css" rel="stylesheet" type="text/css">


</head>
<body>
<div class="box" style="background:#F3F6F5;"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png" width="30" height="30"></a></li>
            <p>提交订单</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="div"></div>
        <div class="address">
            <?php
                $addressCount=count($address);
                if($addressCount==0){?>
                <div class="addres"><a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/add-region'])?>">
                        <img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/tjimg.png" width="30" height="30"> 新增地址
                    </a>
                 </div>
                     <?php }else{?>
                 <dl style="border-top:0; ">
                    <dt>
                        <cite>
                            <input type="radio" id="address" name="address" class="regular-radio big-radio" checked/>
                            <label for="address"></label>
                        </cite>
                    </dt>
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/address','sid'=>$supplier_id])?>">
                        <dd><em><?=$address['consignee']?>  <?=$address['phone']?></em>
                            <span><?=$address['address']?></span>
                        </dd>
                        <div class="clear"></div>
                        <div class="edit">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/right.png">
                        </div>
                    </a>
                </dl>
            <?php }?>
        </div>
                <!--送货方式：开始-->
<!--        <div class="demo">-->
<!--            <ul  style="border-bottom:1px solid #E0DFDF;">-->
<!--                <li class="youji">-->
<!--                    <input type="radio" id="radio-2-2" name="radio-2-set" class="regular-radio big-radio" />-->
<!--                    <label for="radio-2-2"></label>-->
<!--                    <label style=" margin-left:10px;" for="radio-2-2">在线支付</label>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <ul>-->
<!--                <li class="youji">-->
<!--                    <input type="radio" id="payment_method" name="payment_method" class="regular-radio big-radio" checked/>-->
<!--                    <label for="payment_method"></label>-->
<!--                    <label style=" margin-left:10px;" for="payment_method">线下支付</label>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->

		
        <div class="memu">
            <h4>订单商品</h4>
            <?php
            $total = 0;
            $numbers=0;
            foreach ($cart as $_v){
            $number= $_v['number'];
            $product_id=$_v['product_id'];
            $agent=\backend\modules\merchant\models\Agent::findOne($product_id);
            $price=$agent['price'];

            $subtotal=$number*$price;//小计
            $numbers += $number;
            $total += $subtotal;
            ?>
            <dl>
                <dt><h5><?=$_v['name']?></h5>
                <em>￥<?=$price?></em><span>x<?=$number?></span>
                </dt>
                <dd>
                    <a class="btn">删除</a>
                    <input type="hidden" value="<?=$_v['id']?>" class="cartId"/>
                </dd>
                <Div class="clear"></Div>

            </dl>
            <?php }?>
            
        </div>

        <div class="timebox">
            <div class="demos">
                <label for="appDateTime">提货时间</label>
                <input value="<?=date("Y-m-d H:i:s")?>" class="thtime" readonly name="appDateTime" id="appDateTime" type="text">
<!--                <label for="appDate">提货时间</label>-->
<!--                <input value="" class="thtime" readonly="readonly" name="appDate" id="appDate" type="text">-->
            </div>
        </div>
        <div class="remark">
            <dl>
                <dt>备&nbsp;&nbsp;&nbsp;&nbsp;注</dt>
                <dd class="topBarx"><textarea id="remark" placeholder="给商家留言!!"></textarea></dd>
                <div class="clear"></div>
            </dl>
        </div>
    </div>

    <!--悬浮菜单：开始-->
    <div class="bottomMenu">
        <dl>
            <dt><a href="#"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/wqw.png">共<span>￥<?=$total?></span></a></dt>
            <dd id="conf">确认下单</dd>
            <div class="clear"></div>
        </dl>
        <div id="sing"><?=$numbers?></div>
    </div>
    <!--悬浮菜单：结束-->
</div>

</body>
</html>
<script src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery.hDialog.js"></script>
<script>
    var csrfName = $('meta[name=csrf-param]').prop('content');
    var crsfToken = $('meta[name=csrf-token]').prop('content');
    $('.btn').click(function() {
        var cartId=$('.cartId');
        var data =csrfName + '='+crsfToken+"&cartId="+cartId.val();
        $.dialog('confirm','提示','您确定要删除<br>该条选购的商品吗？',0,function(){
//                alert(data);
            $.post("<?=\yii\helpers\Url::to(['delete-cart'])?>", data, function (result) {
                window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/cart','sid'=>$supplier_id])?>";
            });
        });
    });
    var checkSubmitFlg = false;
    $('#conf').click(function() {
        if (!checkSubmitFlg) {
            var addressCounts='<?=$addressCount?>';
            var address_id='<?=$address['id']?>';
   //         var method=1;
            var cart='<?=count($cart)?>';
            var thtime= $('.thtime');
            var remark= $('#remark');

            if(addressCounts==0){
                $.dialog('confirm','提示','您还没填写收货地址呢!<br>确认前往填写？',0,function(){
                    window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/add-region'])?>";
                });
            }else if(!$('#address').attr("checked")){
                $.tooltip('还没选择收货地址呢');
            } else if(thtime.val() === ''){
                $.tooltip('提货时间还没选呢...'); thtime.focus();
            }else  if(cart==0){
                $.dialog('confirm','提示','您还没选购商品呢!<br>确认前往选购？',0,function(){
                    window.location.href = document.referrer;//返回上一页并刷新  
                });
            }else{
                var data =csrfName + '='+crsfToken+"&address_id="+address_id+"&remark="+remark.val()+"&thtime="+thtime.val()+"&supplier_id="+<?=$supplier_id?>;
                if (!checkSubmitFlg) {
                    checkSubmitFlg = true;// 第一次提交
                    $.post("<?=\yii\helpers\Url::to(['save-order'])?>", data, function (result) {
                        window.location.href = result;
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

</script>


<script type="text/javascript">
    $(function () {
        var currYear = (new Date()).getFullYear();
        var opt={};
        opt.date = {preset : 'date'};
        opt.datetime = {preset : 'datetime'};
        opt.time = {preset : 'time'};
        opt.default = {
            theme: 'android-ics light', //皮肤样式
            display: 'modal', //显示方式
            mode: 'scroller', //日期选择模式
            dateFormat: 'yyyy-mm-dd',
            lang: 'zh',
            showNow: true,
            nowText: "今天",
            startYear: currYear -0, //开始年份
            endYear: currYear + 10 //结束年份
        };

        $("#appDate").mobiscroll($.extend(opt['date'], opt['default']));
        var optDateTime = $.extend(opt['datetime'], opt['default']);
        var optTime = $.extend(opt['time'], opt['default']);
        $("#appDateTime").mobiscroll(optDateTime).datetime(optDateTime);
        $("#appTime").mobiscroll(optTime).time(optTime);
    });
</script>

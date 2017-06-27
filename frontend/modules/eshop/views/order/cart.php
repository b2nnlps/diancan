<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 20:34
 */
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= Yii::$app->params['eshop']?></title>
    <?= \yii\helpers\Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/qqq.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/font1/xiaogan.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>
    <script language="javascript">
        function show(a){
            if(a){$(".contentt").fadeOut(500);$(".fix_mask").fadeOut(500);}else{$(".contentt").fadeIn(500);$(".fix_mask").fadeIn(500);}
        }
    </script>
</head>
<body>
<div class="box" style="background:#F3F6F5;"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
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
            if($addressCount==0){
            ?>
            <div class="addres">
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/add-region'])?>">
                    <ins class="icon-23"></ins> 新增地址
                </a>
            </div>
            <?php }else{?>

            <dl>
                <dt>
                    <cite>
                        <input type="radio" id="radio-3-2" name="radio-3-set" class="regular-radio big-radio" checked/>
                        <label for="radio-3-2"></label>
                    </cite>
                </dt>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/address'])?>">
                <dd><h6><?=$address['consignee']?>  <?=$address['phone']?></h6>
                    <span><?=$address['address']?></span>
                </dd>
                <div class="clear"></div>
                <div class="edit">
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/right.png">
                </div>
                </a>
            </dl>
        <?php }?>
        </div>
        <!--送货方式：开始-->
        <div class="demo">

<!--            <ul  style="border-bottom:1px solid #E0DFDF;">-->
<!--                <li class="youji"> <cite>-->
<!--                        <input type="radio" id="radio-2-2" name="radio-2-set" class="regular-radio big-radio" />-->
<!--                        <label for="radio-2-2"></label>-->
<!--                    </cite> <a href="#">在线支付</a> </li>-->
<!--            </ul>-->
            <!--货到付款-->
            <ul>
                <li class="youji"> <cite>
                        <input type="radio" id="radio-2-3" name="radio-2-set" class="regular-radio big-radio" checked/>
                        <label for="radio-2-3"></label>
                    </cite> <a href="#">货到付款</a> </li>
            </ul>
        </div>

        <div class="memu">
            <h4>订单商品</h4>
            <?php
            $total = 0;
            $numbers=0;
            foreach ($cart as $_v){
                $number= $_v['number'];
                $price=$_v['price'];
                $subtotal=$number*$price;//小计
                $numbers += $number;
                $total += $subtotal;
            ?>

                <dl>
                    <dt><h5><?=$_v['name']?></h5>
                    <span>x<?=$number?></span><em>￥<?=$subtotal?></em>
                    </dt>
                    <dd>
                        <a class="btn">删除</a>
                        <input type="hidden" value="<?=$_v['id']?>" class="productid"/>
                    </dd>
                    <Div class="clear"></Div>
                    <div class="fied">
<!--                        <div class="gw_num">-->
<!--                            <em class="min">-</em>-->
<!--                            <input type="hidden" value="--><?//=$_v['id']?><!--" class="productid"/>-->
<!--                            <input type="text" disabled="disabled" value="--><?//=$number?><!--" class="num"/>-->
<!--                            <em class="add">+</em>-->
<!--                        </div>-->
                    </div>
                </dl>
            <?php }?>
        </div>
        <div class="remark">
            <dl>
                <dt>备注</dt>
                <dd class="topBarx"><textarea id="remark" placeholder="欢迎留言！！"></textarea></dd>
                <div class="clear"></div>
            </dl>
        </div>
    </div>

    <!--悬浮菜单：开始-->
    <div class="bottomMenu">
        <dl>
            <dt><a href="#"><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/wqw.png">共<span>￥<?=$total?></span></a></dt>
<!--            <dd><a href="--><?//=Yii::$app->urlManager->createAbsoluteUrl(['eshop/index/order-detail'])?><!--">确认下单</a></dd>-->
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
            var productid=$(this).parent().find('input[class*=productid]');
            var data =csrfName + '='+crsfToken+"&productId="+productid.val();
            $.dialog('confirm','提示','您确定要删除<br>该条选购的商品吗？',0,function(){
//                alert(data);
                $.post("<?=\yii\helpers\Url::to(['delete-cart'])?>", data, function (result) {
                    window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/cart','supplier_id'=>$supplier_id])?>";
                });
            });
        });
            var checkSubmitFlg = false;
            $('#conf').click(function() {
            if (!checkSubmitFlg) {
                var addressCounts='<?=$addressCount?>';
                var address_id='<?=$address['id']?>';
                var method=1;
                var cart='<?=count($cart)?>';
                var remark= $('#remark');
                if(addressCounts==0){
                    $.dialog('confirm','提示','您还没填写收货地址呢!<br>确认前往填写？',0,function(){
                        window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/add-region'])?>";
                    });
                }else if(!$('#radio-3-2').attr("checked")){
                    $.tooltip('还没选择收货地址呢');
                } else if(!$('#radio-2-3').attr("checked")){
                    $.tooltip('还没选择付款方式呢...');
                }else  if(cart==0){
                    $.dialog('confirm','提示','您还没选购商品呢!<br>确认前往选购？',0,function(){
                        window.location.href="javascript:history.go(-1)";
                    });
                }else{
                 //    $.dialog('confirm','提示','现在确认下单吗？',0,function(){
                        var data =csrfName + '='+crsfToken+"&address_id="+address_id+"&method="+method+"&remark="+remark.val()+"&supplier_id="+<?=$supplier_id?>;
//                        alert(data);
                         if (!checkSubmitFlg) {
                            checkSubmitFlg = true;// 第一次提交
                            $.post("<?=\yii\helpers\Url::to(['save-order'])?>", data, function (result) {
                                window.location.href=result;
                            });
                        }
						
                 //    });
                }
                  return true;
            } else {
                //重复提交
                $.tooltip('请勿重复提交！');
                return false;
            }
          });

</script>


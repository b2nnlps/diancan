<?php
use backend\modules\merchant\models\Member;
use yii\helpers\Html;
session_start(); //根据当前SESSION生成随机数
$code = mt_rand(0,1000000);
$_SESSION['rep_sqgx'] = $code; //将此随机数暂存入到session


?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <?=\yii\helpers\Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/shop.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png" width="30" height="30"></a></li>
            <p>更新商品</p>
            <li id="save" style=" font-size:14px; color:#FF4A83; "></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="shop_updtate_box">
            <div class="shop_updtate clearfix">
                <span>商品名称</span>
                <em><?=$product['name']?></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>售&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价</span>
                <em><input type="text" id="price" placeholder="请输入售价信息" value="<?=$model['price']?>"></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>实时库存</span>
                <em><input type="text" id="stock" placeholder="请输入库存数量" value="<?=$model['stock']?>"></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>可预订量</span>
                <em><input type="text" id="bookable" placeholder="请输入库存数量" value="<?=$model['bookable']?>"></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>是否上架</span>
                <em>
                    <?php $status=$model['status']; ?>
                    <select id="status">
                        <option value="1" <?php if($status==1){echo 'selected="selected"'; }?>>是</option>
                        <option value="2" <?php if($status==0){echo 'selected="selected"'; }?>>否</option>
                    </select>
                </em>
            </div>
            <div class="shop_updtate clearfix">
                <span>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</span>
                <em><textarea id="remark"><?=$model['remark']?></textarea></em>
            </div>
        </div>
        <input type="hidden" name="originator" id="originator" value="<?= $code;?>">
        <div class="submit"><button id="conf">提交</button></div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>
<script src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery.hDialog.js"></script>
<script>
    $(function(){
        $('#conf').click(function() {
            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');

            var stock= $('#stock').val();
            var bookable= $('#bookable').val();
            var price= $('#price').val();

            var status= document.getElementById("status").value;
            var remark= $('#remark').val();
            var originator= $('#originator').val();
            var agentID=<?=$model['id']?>;

            var data =csrfName + '='+crsfToken+"&status="+status+"&remark="+remark+"&originator="+originator+"&agentID="+agentID+"&stock="+stock+"&bookable="+bookable+"&price="+price;
//               alert(data);
            $.post("<?=\yii\helpers\Url::to(['user/product-save'])?>", data, function (result) {
                if(result!==''){
                    $.dialog( 'alert','温馨提示', result, 4000,true);
                }else{
                    window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/product-gl'])?>";
                }

            });

        });
    });
</script>
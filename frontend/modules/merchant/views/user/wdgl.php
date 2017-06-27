<?php
use backend\modules\merchant\models\Member;
use yii\helpers\Html;
session_start(); //根据当前SESSION生成随机数
$code = mt_rand(0,1000000);
$_SESSION['rep_wdgl'] = $code; //将此随机数暂存入到session


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
            <p>微店管理</p>
            <li id="save" style=" font-size:14px; color:#FF4A83; "></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="shop_updtate_box">
            <div class="shop_updtate clearfix">
                <span>微店名称</span>
                <em><input type="text" id="name" placeholder="请输入微店名称" value="<?=$model['name']?>"></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>微店地址</span>
                <em><input type="text" id="address" placeholder="请输入微店地址" value="<?=$model['address']?>"></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>联系电话</span>
                <em><input type="text" id="phone" placeholder="请输入联系电话" value="<?=$model['phone']?>"></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>营业时间</span>
                <em><input type="text" id="open_hours" placeholder="请输入营业时间" value="<?=$model['open_hours']?$model['open_hours']:'每天8:00至22:00';?>"></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>简&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;述</span>
                <em><textarea id="brief"><?=$model['brief']?$model['brief']:'感谢您来光顾我的微店，祝您购物愉快！';?></textarea></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>下单须知</span>
                <em><textarea id="notice"><?=$model['notice']?$model['notice']:'如有疑问，请于商家联系！欢迎惠顾！'?></textarea></em>
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

<?php
if($model['rank']==1){
    $link=Yii::$app->urlManager->createAbsoluteUrl(['merchant/good/product-list','sid'=>$model['id']]);
}else{
    $link=Yii::$app->urlManager->createAbsoluteUrl(['merchant/default/product-list','sid'=>$model['id']]);
}
?>
<script>
    $(function(){
        $('#conf').click(function() {
            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');

            var sid=<?=$model['id']?>;
            var name= $('#name').val();
            var address= $('#address').val();
            var phone= $('#phone').val();

            var open_hours= $('#open_hours').val();
            var brief= $('#brief').val();
            var notice= $('#notice').val();
            var originator= $('#originator').val();

            var data =csrfName + '='+crsfToken+"&sid="+sid+"&name="+name+"&address="+address+"&phone="+phone+"&open_hours="+open_hours+"&brief="+brief+"&notice="+notice+"&originator="+originator;
             //  alert(data);
            $.post("<?=\yii\helpers\Url::to(['user/wdinfo-save'])?>", data, function (result) {
                if(result!==''){
                    $.dialog( 'alert','温馨提示', result, 4000,true);
                }else{
                    window.location.href="<?=$link?>";
                }

            });

        });
    });
</script>
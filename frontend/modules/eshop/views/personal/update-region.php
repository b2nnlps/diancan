<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 21:01
 */
use backend\modules\sys\models\District;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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
    <script src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/jquery-1.8.3.min.js"></script>

</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
            <p>更新地址</p>
            <li id="save" style=" font-size:14px; color:#FF4A83; ">保存</li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="contacts">
            <span>联系人</span>
            <input id="consignee" type="text" value="<?=$model['consignee']?>" placeholder="联系人姓名" />
        </div>

        <div class="demox">
            <ul>
                <li class="person"> 
                    <cite>
<!--                            <input type="checkbox" onclick="return check();" id="checkbox_c1" class="chk_3"  --><?php //if($show==1){echo " checked=\"checked\""; }?><!-- />-->

                        <input id="defaults"  type="checkbox" <?php if($model['default']==10){echo " checked=\"checked\""; }?> />
                        <label for="radio-2-2"></label>
                    </cite> 
                    <a href="#">默认地址</a> 
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>

        <div class="cellphone">
            <span>地址详情</span>
            <input id="address" type="text" value="<?=$model['address']?>" placeholder="地址详情" />
        </div>
        <div class="cellphone">
            <span>手机号码</span>
            <input id="phone" type="text" value="<?=$model['phone']?>" placeholder="联系人手机号码" />
        </div>
        
        <div class="cellphone">
            <span>邮政编码</span>
            <input id="zipcode" type="text" value="<?=$model['zipcode']?>" placeholder="邮政编码" />
        </div>

    </div>
</div>
</body>
</html>

<script src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery.hDialog.js"></script>
<script>

    $(function(){
        var checkSubmitFlg = false;
        $('#save').click(function() {
            if (!checkSubmitFlg) {
                var csrfName = $('meta[name=csrf-param]').prop('content');
                var crsfToken = $('meta[name=csrf-token]').prop('content');

                var consignee=$('#consignee');

                var defaults=document.getElementById("defaults");
                if(defaults.checked){
                    var shows=10;//选中了
                }else{
                    var shows=1;//没选中
                }
//                var provinvce= document.getElementById("provinvce").value;
//                var city= document.getElementById("city").value;
//                var district= document.getElementById("district").value;
                var address= $('#address');
                var reg=/(1[3-9]\d{9}$)/;
                var phone= $('#phone');
                var zipcode= $('#zipcode');

                //            alert($number.val());
                if(consignee.val()=== ''){
                    $.tooltip('还没填写联系人呢..'); consignee.focus();
                }
//                else if(provinvce=== ''){
//                    $.tooltip('还没选择省份呢...');
//                }else if(city=== ''){
//                    $.tooltip('还没选择市区呢...');
//                }else if(district=== ''){
//                    $.tooltip('还没选择县市呢...');
//                }
                else if(address.val()=== ''){
                    $.tooltip('还没填写详细信息呢...'); address.focus();
                }else if(phone.val() === ''){
                    $.tooltip('手机号码还没填呢...'); phone.focus();
                }else if(!reg.test(phone.val())){
                    $.tooltip('手机号码格式错误...'); phone.focus();
                }else{
                    // 第一次提交
                    checkSubmitFlg = true;
                    var data =csrfName + '='+crsfToken+"&consignee="+consignee.val()+"&phone="+phone.val()+"&defaults="+shows+"&address="+address.val()+"&zipcode="+zipcode.val()+"&id="+<?=$model['id']?>;
//                                        alert(data);
                    $.post("<?=\yii\helpers\Url::to(['save-region'])?>", data, function (result) {
                        if(result!==''){
                            checkSubmitFlg = false;
                            $.dialog( 'alert','温馨提示', result, 4000,true);
                        }else{
//                                    $.dialog('confirm','提示',result,0,function(){
                            window.location.href="javascript:history.go(-1)";
//                            window.location.href="<?//=Yii::$app->urlManager->createAbsoluteUrl(['eshop/index/cart'])?>//";
//                                    });
                        }
                    });
                }
                //  return true;
            } else {
                //重复提交
                $.tooltip('请勿重复提交！');
                return false;
            }
        });
    });

</script>

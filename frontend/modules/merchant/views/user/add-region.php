<?php
use yii\helpers\Html;
session_start(); //根据当前SESSION生成随机数
$code = mt_rand(0,1000000);
$_SESSION['rep_verify'] = $code; //将此随机数暂存入到session
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <?=Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/user.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/user_xz.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png"width="30" height="30"></a></li>
            <p>新增地址</p>
            <li id="save" style=" font-size:14px;color:#FE4543;">保存</li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="contacts">
            <span>联系人</span>
            <input id="consignee" type="text" placeholder="联系人姓名" />
        </div>
        <div class="demox">
            <div class="opt">
                <input class="magic-checkbox" type="checkbox" name="layout" id="defaults">
                <label for="defaults">默认地址</label>
            </div>
        </div>
        <div class="clear"></div>
        <div class="cellphone"><span>地址详情</span><input id="address" type="text" placeholder="地址详情" /></div>
        <div class="cellphone">
            <span>手机号码</span><input id="phone" type="text" placeholder="联系人手机号码" />
        </div>

        <div class="cellphone"><span>邮政编码</span><input id="zipcode" type="text" placeholder="邮政编码" /></div>
        <input type="hidden" name="originator" id="originator" value="<?= $code;?>">
    </div>
</div>
</body>
</html>

<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>
<script src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery.hDialog.js"></script>
<script>
    $(function(){
        $('#save').click(function() {
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
                var originator= $('#originator').val();
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
                    var data =csrfName + '='+crsfToken+"&consignee="+consignee.val()+"&phone="+phone.val()+"&defaults="+shows+"&address="+address.val()+"&zipcode="+zipcode.val()+"&originator="+originator;
//                     alert(data);
                    $.post("<?=\yii\helpers\Url::to(['save-region'])?>", data, function (result) {
                        if(result!==''){
                            $.dialog( 'alert','温馨提示', result, 4000,true);
                        }else{
                                window.location.href = document.referrer;//返回上一页并刷新  
							
                        }
                    });
                }
          
        });
    });

</script>

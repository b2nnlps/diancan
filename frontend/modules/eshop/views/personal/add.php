<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-23
 * Time: 17:16
 */
use yii\helpers\Html;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= Yii::$app->params['eshop']?></title>
    <?=Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/registe.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/fontico.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/font1/xiaogan.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
            <p>完善个人资料</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div id="registe_form">
            <div class="input_div">
                <label><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/login1.png" width="25" height="25"></label>
                <input class="input_text" type="text" name="name" id="realname" placeholder="真实姓名" />
            </div>
            <div class="input_div">
                <label><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/login2.png" width="25" height="25"></label>
                <input class="input_text" type="text" name="picVercode" id="phone" placeholder="常用手机号码" />

            </div>
            <div class="input_div">
                <label><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/login4.png" width="25" height="25"></label>
                <input class="input_text" type="text" name="name" id="verifycode" placeholder="短信验证码" />
                <input type="button" style="background:#FF4683; color:#FFF; border:0; padding:0 15px;" id="subBtn" value="获取验证码"/>
            </div>
			  <div class="input_div">
                <label><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/yao.png" width="25" height="25"></label>
                <input class="input_text" type="text" name="name" id="yq" placeholder="店家手机号码" />
            </div>
            <div class="input_div">
                <label><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/login5.png" width="25" height="25"></label>
                <input class="input_text" type="text" name="name" id="address" placeholder="详细地址" />
            </div>
            <input type="button" name="registeBtn" id="registeBtn" class="btn" value="提交" />
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="<?=Yii::$app->request->baseUrl?>/hDialog/css/animate.css"/> <!-- 动画效果 -->
<link rel="stylesheet" href="<?=Yii::$app->request->baseUrl?>/hDialog/css/common.css"/><!-- 页面基本样式 -->
<script src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery.hDialog.js"></script>
<script>
    $(function(){
        $('#subBtn').click(function() {//点击获取验证码
            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');
            var $phone= $('#phone');
            var reg=/(1[3-9]\d{9}$)/;
            if($phone.val() === ''){
                $.tooltip('手机号码还没填呢...'); $phone.focus();
            }else if(!reg.test($phone.val())){
                $.tooltip('手机号码格式错误...'); $phone.focus();
            }else{
                var data =csrfName + '='+crsfToken+"&phone="+$phone.val();
                $.post("<?=\yii\helpers\Url::to(['personal/verifycode'])?>", data, function (result) {
                    $.dialog( 'alert','温馨提示', result, 4000,true);
                });
            }
        });
        $('.btn').click(function() {
            //paraName 等找参数的名称
            function GetUrlParam(paraName) {//Js获取指定Url参数
                var url = document.location.toString();//获取当前网址
                var arrObj = url.split("?");//截取“？”两边的内容
                if (arrObj.length > 1) {//判断问号两边的长度
                    var arrPara = arrObj[1].split("&");
                    var arr;
                    for (var i = 0; i < arrPara.length; i++) {
                        arr = arrPara[i].split("=");

                        if (arr != null && arr[0] == paraName) {
                            return arr[1];
                        }
                    }
                    return "";
                }else {
                    return "";
                }
            }
            //         GetUrlParam("id");//假如当网页的网址有这样的参数 test.htm?id=896&s=q&p=5，则调用 GetUrlParam("p")，返回 5。
            var openid=GetUrlParam("openid");

            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');

            var $name= $('#realname');
            var $realname=$name.val().replace(/\s+/g,"");//去掉字符串所以空格
            var namelgth=$realname.length;//获取字符串长度

            var address= $('#address');
            var address1=address.val().replace(/\s+/g,"");//去掉字符串所以空格
            var addresslgth=address1.length;//获取字符串长度

			 var yq= $('#yq');
			  
            var reg=/(1[3-9]\d{9}$)/;
            var $phone= $('#phone');
            var $verifycode= $('#verifycode');
            var $code=$verifycode.val().replace(/\s+/g,"");//要传的验证码
            var codelgth=$code.length;

            if($realname=== ''){
                $.tooltip('姓名还没填呢...'); $name.focus();
            }else if(namelgth>20){
                $.tooltip('姓名不能超过20个字符'); $name.focus();
            }else if($phone.val() === ''){
                $.tooltip('手机号码还没填呢...'); $phone.focus();
            }else if(!reg.test($phone.val())){
                $.tooltip('手机号码格式错误...'); $phone.focus();
            }else if($code===''){
                $.tooltip('验证码还没填呢...'); $verifycode.focus();
            }else if(codelgth!==4||isNaN($code)){//判断是否为四位纯数字的验证码
                $.tooltip('验证码必须是4位纯数字'); $verifycode.focus();
            }else if(yq.val() === ''){
                $.tooltip('店家手机号码还没填呢...'); yq.focus();
            }else if(!reg.test(yq.val())){
                $.tooltip('店家手机号码格式错误...'); yq.focus();
            }else if(address1=== ''){
                $.tooltip('详细地址还没填呢...'); address.focus();
            }else if(addresslgth>120){
                $.tooltip('详细地址不能超过120个字符'); address.focus();
            }else{
                var data =csrfName + '='+crsfToken+"&realname="+$realname+"&phone="+$phone.val()+"&code="+$code+"&openid="+openid+"&address="+address1+"&yq="+yq.val();
                $.post("<?=\yii\helpers\Url::to(['personal/register'])?>", data, function (result) {
//                    alert(result);
                    if(result!==''){
                        $.dialog( 'alert','温馨提示', result, 4000,true);
                    }else{
                         window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/good/index'])?>";
                    }

                });
            }
        });
    });
</script>


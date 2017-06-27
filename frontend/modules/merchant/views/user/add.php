<?php
use yii\helpers\Html;
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
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png" width="30" height="30"></a></li>
            <p>完善资料</p>
            <li id="save" style=" font-size:14px; color:#FE4543; display:none; ">保存</li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="data_box">
            <span>微信昵称</span>
            <em><?=\backend\modules\sys\models\WechatUser::getNickname($wx_openid)?></em>
        </div>
        <div class="data_box">
            <span>姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</span>
            <em><input type="text" id="realname" placeholder="输入您的姓名"></em>
        </div>
        <div class="data_box">
            <span>手机号码</span>
            <em><input type="text" id="phone" placeholder="输入您的手机号码"></em>
        </div>


        <div class="data_box">
            <span>详细地址</span>
            <em><input type="text"  id="address" placeholder="输入您的详细地址"></em>
        </div>
        <div class="data_box clearfix" id="bzdiv">
            <span>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</span>
            <em>
                <div class="opt" id="opt1">
                    <input class="magic-radio" type="radio" name="sex" id="bm" value="10" checked>
                    <label for="bm">保密</label>
                </div>
                <div class="opt" id="opt1">
                    <input class="magic-radio" type="radio" name="sex" id="nan" value="1">
                    <label for="nan">男</label>
                </div>
                <div class="opt" id="opt1">
                    <input class="magic-radio" type="radio" name="sex" id="nv" value="0">
                    <label for="nv">女</label>
                </div>
            </em>
        </div>

        <div class="data_box clearfix" id="bzdiv">
            <span>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</span>
            <em><textarea  id="remark"></textarea></em>
        </div>
        <input name="sub_rand" type="hidden" id="sub_rand" value="<?= rand(10000,100000000000);?>" />
    </div>
    <div class="refer1"><button type="submit" class="btn">提交</button></div>
</div>
</body>
</html>
<script type="text/javascript" src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>
<script src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery.hDialog.js"></script>
<script>
    $(function(){
        $('.btn').click(function() {
            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');

            var $name= $('#realname');
            var $realname=$name.val().replace(/\s+/g,"");//去掉字符串所以空格
            var namelgth=$realname.length;//获取字符串长度

            var reg=/(1[3-9]\d{9}$)/;
            var $phone= $('#phone');

            var address= $('#address');
            var address1=address.val().replace(/\s+/g,"");//去掉字符串所以空格
            var addresslgth=address1.length;//获取字符串长度

            var remark= $('#remark').val();
            var sub_rand= $('#sub_rand').val();

            var Obj = document.getElementsByName("sex");
            for(i=0;i<Obj.length;i++){if(Obj[i].checked){break}}
            var sex=Obj[i].value;

            if($realname=== ''){
                $.tooltip('姓名还没填呢...'); $name.focus();
            }else if(namelgth>20){
                $.tooltip('姓名不能超过20个字符'); $name.focus();
            }else if($phone.val() === ''){
                $.tooltip('手机号码还没填呢...'); $phone.focus();
            }else if(!reg.test($phone.val())){
                $.tooltip('手机号码格式错误...'); $phone.focus();
            }else if(address1=== ''){
                $.tooltip('详细地址还没填呢...'); address.focus();
            }else if(addresslgth>120){
                $.tooltip('详细地址不能超过120个字符'); address.focus();
            }else{
                var data =csrfName + '='+crsfToken+"&realname="+$realname+"&phone="+$phone.val()+"&address="+address1+"&sex="+sex+"&remark="+remark+"&sub_rand="+sub_rand+"&type=add";
               // alert(data);
                $.post("<?=\yii\helpers\Url::to(['user/register'])?>", data, function (result) {
                    if(result=='error:1'){
                        $.dialog( 'alert','温馨提示', '相关参数值不能为空！', 4000,true);
                    }else if(result=='error:2'){
                        $.dialog( 'alert','温馨提示', '不能重复提交表单！', 4000,true);
                    }else {
                        window.location.href = document.referrer;//返回上一页并刷新  
                    }

                });
            }
        });
    });
</script>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-16
 * Time: 16:55
 */
use backend\modules\sys\models\WechatUser;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合活动吧</title>
    <?= \yii\helpers\Html::csrfMetaTags()?>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/fontico.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/return.png" width="20" height="20"></a></li>
            <p>申请管理员</p>
            <li></li>
            <div class="clear"></div>
        </ul>
    </div>

    <div class="databox">
        <div class="succeed">
            <img src="<?=WechatUser::getHeadimgurl($wechat_openid)?>" width="80px">
            <p style=" font-size: 16px; color: #009AE7; margin-top: 2px;"><?=WechatUser::getNickname($wechat_openid)?></p>
        </div>
        <dl class="clearfix">
            <dt>姓 名：</dt>
            <dd><input type="text" id="name"></dd>
        </dl>
        <dl class="clearfix">
            <dt>手 机：</dt>
            <dd><input type="text" id="phone"></dd>
        </dl>
        <dl class="clearfix">
            <dt>微信号：</dt>
            <dd><input type="text" id="wx"></dd>
        </dl>
        <dl class="clearfix">
            <dt>备 注：</dt>
            <dd><textarea id="remark"></textarea></dd>
        </dl>
    </div>
    <div class="annotation">
        <dl class="clearfix">
            <dt style=" color:#F00;">注：</dt>
            <dd><ul>
                    <li><span>1</span>为了方便审核通过，请填写真实信息，我们将对信息严格保密。</li>
                </ul>
            </dd>
        </dl>
    </div>
    <div class="footer"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/about']) ?>">容合<img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/logo.png" width="20" height="20"/>活动吧</a></div>
    <div class="submitBtn">提 交</div>
</div>
</body>
</html>

<script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/js/jquery.hDialog.js"></script>

<script>
    /**
     * 返回顶部，报名窗口，助力点赞提示
     * @returns {undefined}
     */
    $(function(){
        var checkSubmitFlg = false;
        $('.submitBtn').click(function() {//提交报名并验证表单
            if (!checkSubmitFlg) {
                var csrfName = $('meta[name=csrf-param]').prop('content');
                var crsfToken = $('meta[name=csrf-token]').prop('content');
                var PhoneReg =/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/; //手机正则
                var name = $('#name');
                var phone = $('#phone');
                var wx = $('#wx');
                var aid =<?=$aid?>;
                var remark = $('#remark');
                if(name.val() === ''){
                    $.tooltip('姓名还没填呢...'); name.focus();
                }else if(phone.val() === ''){
                    $.tooltip('手机还没填呢...'); phone.focus();
                }else if(!PhoneReg.test(phone.val())){
                    $.tooltip('手机格式错咯...'); phone.focus();
                }else if(wx.val() === ''){
                    $.tooltip('微信号还没填呢...'); wx.focus();
                }else{

                    var data =csrfName + '='+crsfToken+"&aid="+aid+"&name="+name.val()+"&phone="+phone.val()+"&wx="+wx.val()+"&remark="+remark.val();
                  // alert(data);
                    if (!checkSubmitFlg) {
                        checkSubmitFlg = true;// 第一次提交
                        $.post("<?=\yii\helpers\Url::to(['apply/adminadd'])?>", data, function (result) {
                            if(result!==''){
                                $.dialog( 'alert','温馨提示', result, 4000,true);
                            }else{
                                window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/scs'])?>";
                            }
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
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-16
 * Time: 16:55
 */

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
            <p>我要报名</p>
            <li></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="databox">
        <dl class="clearfix">
            <dt>姓 名：</dt>
            <dd><input type="text" id="name"></dd>
        </dl>
        <dl class="clearfix">
            <dt>手 机：</dt>
            <dd><input type="text" id="phone"></dd>
        </dl>
        <dl class="clearfix">
            <dt>人 数：</dt>
            <dd><input type="text" id="number"></dd>
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
<!--                    <li><span>1</span>请报名活动篇二的，报名成功后联系活动组织者缴费。</li>-->
                    <li>请填写真实信息方便活动组织者与您取得联系，我们将对信息严格保密。</li>
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
                var remark = $('#remark');
                var ac_id =<?=$aid?>;
                var number = $('#number');

                if(name.val() === ''){
                    $.tooltip('姓名还没填呢...'); name.focus();
                }else if(phone.val() === ''){
                    $.tooltip('手机还没填呢...'); phone.focus();
                }else if(!PhoneReg.test(phone.val())){
                    $.tooltip('手机格式错咯...'); phone.focus();
                }else if(number.val() === ''){
                    $.tooltip('参加人数没填呢...'); number.focus();
                }else if(isNaN(number.val())){
                    $.tooltip('参加人数必须为整数...'); number.focus();
                } else{
                    var data =csrfName + '='+crsfToken+"&activity_id="+ac_id+"&number="+number.val()+"&name="+name.val()+"&phone="+phone.val()+"&remark="+remark.val();
//                    alert(data);
                    if (!checkSubmitFlg) {
                        checkSubmitFlg = true;// 第一次提交
                        $.post("<?=\yii\helpers\Url::to(['apply/add'])?>", data, function (result) {
                            if(result!==''){
                                $.dialog( 'alert','温馨提示', result, 4000,true);
                            }else{
                                window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/success'])?>";
                            }
                        });

                    }
                }
                return true;
            } else {
                //重复提交
                $.tooltip('请勿重复提交相同信息！或刷新后再提交！');
                return false;
            }

        });
    });
</script>
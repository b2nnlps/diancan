<?php
use backend\modules\merchant\models\Member;
use yii\helpers\Html;
session_start(); //根据当前SESSION生成随机数
$code = mt_rand(0,1000000);
$_SESSION['rep_uinfo'] = $code; //将此随机数暂存入到session

$remark=$model['remark'];
$sdasd=$model['sdasd'];
$hobbyArray=$model['hobby'];
$hobbyStr= explode(",", $hobbyArray);
$hobby='';
foreach ($hobbyStr as  $val){
    $hobby.=Member::hobby($val).',';
}
$hobby=rtrim($hobby, ",") ;//去掉最后一个“，”

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <?=Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/user.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png" width="30" height="30"></a></li>
            <p>用户详情</p>
            <li id="save" style=" font-size:14px; color:#FE4543; display:none;"><a href="#">更新</a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="data_box">
            <span>姓&nbsp;&nbsp;&nbsp;名</span>
            <em><?=$model['realname']?></em>
        </div>
        <div class="data_box">
            <span>性&nbsp;&nbsp;&nbsp;别</span>
            <em><?=Member::sex($model['sex'])?></em>
        </div>
        <div class="data_box">
            <span>手机号码</span>
            <em><?=$model['phone']?></em>
        </div>
        <div class="data_box">
            <span>地址详情</span>
            <em><?=$model['address']?></em>
        </div>
        <div class="data_box">
            <span>级&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</span>
            <em><?=Member::rank($model['rank'])?></em>
        </div>
        <div class="data_box">
            <span>爱&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;好</span>
            <em><?=$hobby?$hobby:'暂无'?></em>
        </div>
        <div class="data_box clearfix" id="bzdiv">
            <span>个性签名  </span>
            <em>  <?=$sdasd?$sdasd:'暂无'?></em>
        </div>

        <?php if($inArray==1){?>
         <div class="data_box">
             <span>会员等级</span>
             <em>
                 <?php $rank=$model['rank']; ?>
                 <select id="rank">
                     <option value="1" <?php if($rank==1){echo 'selected="selected"'; }?>>供应商</option>
                     <option value="2" <?php if($rank==2){echo 'selected="selected"'; }?>>代理商</option>
                     <option value="3" <?php if($rank==3){echo 'selected="selected"'; }?>>会员</option>
                 </select>
             </em>
         </div>
         <div class="data_box clearfix" id="bzdiv">
             <span>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</span>
             <em><textarea id="remark"><?=$model['remark']?></textarea></em>
         </div>
        <input type="hidden" name="originator" id="originator" value="<?= $code;?>">
		<div class="refer1"><button type="submit" class="btn">提交</button></div>
        <?php }?>
        
    </div>
    
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
            
            var rank= document.getElementById("rank").value;
            var remark= $('#remark').val(); 
            var originator= $('#originator').val();
            var rh_openid='<?=$rh_openid?>';
            var data =csrfName + '='+crsfToken+"&rank="+rank+"&remark="+remark+"&originator="+originator+"&rh_openid="+rh_openid;
//               alert(data);
            $.post("<?=\yii\helpers\Url::to(['user/info-save'])?>", data, function (result) {
                if(result!==''){
                    $.dialog( 'alert','温馨提示', result, 4000,true);
                }else{
                    window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/user-list'])?>";
                }

            });

        });
    });
</script>
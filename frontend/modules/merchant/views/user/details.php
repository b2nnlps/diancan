<?php
use backend\modules\merchant\models\Member;

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
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/user.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png" width="30" height="30"></a></li>
            <p>个人资料</p>
            <li id="save" style=" font-size:14px; color:#FE4543; "><a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/update','rh_openid'=>$model['rh_openid']])?>">更新</a></li>
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
        <!-- <div class="data_box">
             <span>会员等级</span>
             <em>
                <select>
                   <option>供应商</option>
                   <option>代理</option>
                   <option>会员</option>
                </select>
             </em>
         </div>
         <div class="data_box clearfix" id="bzdiv">
             <span>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</span>
             <em><textarea></textarea></em>
         </div>-->
    </div>
    <!--<div class="refer1"><button type="submit" class="btn">提交</button></div>-->
</div>
</body>
</html>

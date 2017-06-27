<?php
use backend\modules\merchant\models\Member;
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
<div class="box">
    <!---头部：开始-->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img  src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png"></a></li>
            <p>会员列表</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <!---头部：结束-->
    <div class="main">
        <div class="seek_box">
            <div class="seek clearfix">
                <input type="text" placeholder="请输入您要查询的姓名">
                <a href="#"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/ssimg.png"></a>
            </div>
        </div>
        <div class="user_list_box">
            <?php
            foreach ($model as $_v){
                $rank=$_v['rank'];
                if($rank==1){$rankColor='#FE4543';}else if($rank==2){$rankColor='#09C';}else{$rankColor='#F60';}
                $phone=$_v['phone'];
                $phoneHid=\common\models\ComModel::hidtel($_v['phone']);
                $wx_openid=$_v['wx_openid'];
                $headimgurl=\backend\modules\sys\models\WechatUser::getHeadimgurl($wx_openid);
                $rh_openid=$_v['rh_openid'];
                $supplier=\backend\modules\merchant\models\Supplier::find()->where(['rh_openid'=>$rh_openid])->one();
                if(!empty($supplier)){
                    $supplierID=$supplier['id'];
                }
                if($rank==1){
                    $link=Yii::$app->urlManager->createAbsoluteUrl(['merchant/good/product-list','sid'=>$supplierID]);
                }elseif ($rank==2){
                    $link=Yii::$app->urlManager->createAbsoluteUrl(['merchant/default/product-list','sid'=>$supplierID]);
                }else{
                    $link=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/user-info','rh_openid'=>$rh_openid]);
                }
            ?>
            <div class="user_list">
                <dl class="clearfix">
                    <dt>
                        <a href="<?=$link?>">
                            <img src="<?=$headimgurl?>">
                        </a>
                    </dt>
                    <dd>
                        <h5>
                            <em><?=$_v['realname']?></em>
                            <Span style="color:<?=$rankColor?>;">-<?=Member::rank($rank)?></Span>
                        </h5>
                        <h6>
                            <span>
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/sjimg1.png" width="15" height="15">
                                <a href="tel:<?=$phone?>" ><?=$phoneHid?></a>
                            </span>
                        </h6>
                    </dd>
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/user-info','rh_openid'=>$rh_openid])?>"><div class="qjdiv"></div></a>
                </dl>
            </div>
            <?php }?>

        </div>
    </div>
</div>
</body>
</html>
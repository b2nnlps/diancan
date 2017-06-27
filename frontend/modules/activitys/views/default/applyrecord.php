<?php
use backend\modules\sys\models\WechatUser;
use backend\modules\activitys\models\ApplyAttend;
$number=0;//设变量
foreach ($applyAttend as $_v){
    $number+=$_v['number'];//累加
}

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title>容合活动吧</title>
	<link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/style.css" rel="stylesheet" type="text/css">
	<link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/fontico.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
	<div class="Favorites">
		<ul class="clearfix">
			<li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/return.png" width="20" height="20"></a></li>
			  <p>报名列表（<?=$number?>）</p>
			<li></li>
		</ul>
	</div>
	<div class="readList">
		<?php foreach ($applyAttend as $_v){
			$status=$_v['status'];
			if($status==0){
				$statusColor='#DD4A38';
			}elseif ($status==1){
				$statusColor='#F39D12';
			}elseif ($status==2){
				$statusColor='#00A75A';
			}?>
			<dl class="clearfix">
				<a href="#">
					<dt><img src="<?=WechatUser::getHeadimgurl($_v['uid'])?>"></dt>
					<dd>
						<h5><?=\common\models\ComModel::cut_str(WechatUser::getNickname($_v['uid']),20 )?>  (<?=$_v['number']?>人)</h5>
						<time>
							<img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/record.png" width="20" height="20">
							<?=date('Y-m-d',strtotime($_v['created_time']))?>
						</time>
						<?php if ($status==2){?>
							<cite><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/money.png" width="20" height="20" ><?=$_v['cost']?></cite>
						<?php } ?>
						<span style="background-color:<?=$statusColor?>;"><?=ApplyAttend::status($_v['status'])?></span>
					</dd>
				</a>
			</dl>
		<?php } ?>
	</div>
	<!--分页器：开始-->
	<div class="digg">
		<!--	<a href="#">首 页</a>
            <a href="#">上一页</a>
            <a href="#">1</a>
            <span class="current"> 2 </span>
            <a href="#">3</a>
            <a href="#">下一页</a>
            <a href="#">尾 页</a>-->
	</div>
        <!--分页器：结束-->
	<div class="footer"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/about']) ?>">容合<img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/logo.png" width="20" height="20"/>活动吧</a></div>

</div>
</body>
</html>

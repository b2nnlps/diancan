<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-27
 * Time: 16:43
 */

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合活动吧</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/activity_v1/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/activity_v1/icon/back.png"></a></li>
            <p>活动列表</p>
            <li></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="listbox">

              <?php
            foreach ($activity as $_v){
                $id=$_v['id'];
                if($id=='1'){
                    $url='http://micro.n39.cn/activity/default/index?id=1&openid=oW2yKjgaf8fAuYYdkjSMUEbZ2n7o&winzoom=1';
                }elseif($id=='2'){
                    $url='http://micro.n39.cn/activitys/relay/index?id=2&openid=oW2yKjgaf8fAuYYdkjSMUEbZ2n7o&winzoom=1';
                }elseif($id=='3'){
                    $url='http://ms.n39.cn/activitys/relay/index?openid=oV1VUt0U0HE0F5T3sCry_LGaFuSA&from=timeline&winzoom=1';
                }
			   $now_time=strtotime(date('Y-m-d H:i:s')); //当前时间
					$start_time=strtotime($_v['start_time']); //活动开始时间
					$end_time=strtotime($_v['end_time']); //活动结束时间
					if($start_time>$now_time){//活动尚未开始
						$bc='#F39D12;';
						$status='未开始';
					}elseif ($end_time<$now_time){//活动已结束
						$bc='#DD4A38;';
						$status='已结束';
					}else{
						$bc='#00A75A;';
						$status='进行中';
					}

				?>
					<a href="<?=$url?>">
						<dl>
							<dt><img src="<?=$_v['imgurl']?>"></dt>
							<dd>
								<h3><?=$_v['title']?></h3>
								<time><img src="<?=Yii::$app->view->theme->baseUrl?>/activity_v1/icon/time.png"><?=date('Y-m-d',$start_time)?>至<?=date('Y-m-d',$end_time)?></time>
								<span><img src="<?=Yii::$app->view->theme->baseUrl?>/activity_v1/icon/browse.png"><?=$_v['visit']?></span>
								<span><img src="<?=Yii::$app->view->theme->baseUrl?>/activity_v1/icon/person.png"><?=$_v['willnum']?></span>
							</dd>
							<div class="clear"></div>
							<p style=" background-color:<?=$bc?>"><?=$status?></p>
						</dl>
					</a>
				<?php }?>

        </div>
    </div>
</div>
</body>
</html>



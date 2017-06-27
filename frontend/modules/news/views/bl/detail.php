<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-04-11
 * Time: 16:36
 */

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>爆料系统</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/icon/return.png" width="30"></a></li>
            <p>详情</p>
            <li></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="Dynamic_details">
            <h4><?=$sysfb['title']?></h4>
            <div class="message">
                <span><img src="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/icon/tiem.png" width="15" height="15"> <?=date('Y-m-d',strtotime($sysfb['created_time']))?></span>
                <span><img src="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/icon/pv.png" width="15" height="15"> <?=$sysfb['pv']?> </span>
            </div>
            <div class="compile">
                <p> <?=$sysfb['content']?></p>
                <?php
                $img=$sysfb['img'];
                if($img!=''){
                    $imgUrl= explode(",", $img);
                    foreach ($imgUrl as $val){
                ?>
                     <img src="<?=Yii::$app->view->theme->baseUrl.$val?>">
                <?php }   }?>
            </div>
        </div>
    </div>
    <!--页脚-->
    <div class="footer">
        <span>© <?=date('Y')?> 琼海市爱国卫生办公室 版权所有</span>
        <span>技术支持： 琼海视窗</span>
    </div>
</div>
</body>
</html>


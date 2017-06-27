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
    <link href="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body style=" background-color:#F4F5F6;">
<div class="box">
    <div class="Favorites">
        <ul>
            <li>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['news/fb/add'])?>">
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/icon/add.png" width="30" height="30">
                </a>
            </li>
            <p><a href="#">爆料列表</a></p>
            <li><a href="#"><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/icon/gr.png" width="30" height="30"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="blank"></div>
    <!---->
    <div class="mian">
        <?php
        foreach ($fbModel as $_v) {
            ?>
            <div class="disclose_list1">
                <div class="list_text1">
                    <ul>
                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['news/fb/detail','id'=>$_v['id']]) ?>">
                            <li><span><?=$_v['title']?></span></li>
                            <li><?php
                                $contentImg=preg_replace("/<img.*?>/si","",$_v['content']);
                                $content = preg_replace("/<br\s?\/?>/i","",$contentImg);
                                echo \common\models\ComModel::cut_str($content,45)?></li>
                            <li><img src="<?= Yii::$app->view->theme->baseUrl ?>/fb_v1.0/icon/tiem.png" width="15" height="15">
                                <em><?=date('Y-m-d',strtotime($_v['created_time']))?></em>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
            <?php } ?>
        <div class="disclose_list clearfix">
            <div class="list_img"><a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['news/fb/detail'])?>"><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/images/nzj.jpg"></a></div>
            <div class="list_text">
                <ul>
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['news/fb/detail'])?>">
                        <li><span>琼海市卫生和计划生育委员会成立</span></li>
                        <li>12月10号上午，我市举行琼海市卫生和计划生育委员会成立大会</li>
                        <li><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/icon/tiem.png" width="15" height="15"><em>2017-4-8</em></li>
                        <li><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/icon/dt.png" width="15" height="15"><em>琼海市卫生管理局</em></li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="disclose_list2">
            <div class="list_text2">
                <ul>
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['news/fb/detail'])?>">
                        <li><span>琼海市卫生和计划生育委员会成立</span></li>
                        <li>12月10号上午，我市举行琼海市卫生和计划生育委员会成立大会</li>
                        <li><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/icon/tiem.png" width="15" height="15"><em>2017-4-8</em></li>
                        <li><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/icon/dt.png" width="15" height="15"><em>琼海市卫生管理局</em></li>
                    </a>
                </ul>
            </div>
            <div class="list_img2">
                <ul class="clearfix">
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['news/fb/detail'])?>">
                        <li><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/images/nzjdx.jpg"></li>
                        <li><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/images/nzj.jpg"></li>
                        <li><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/images/nzjdx.jpg"></li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
    <!--页脚-->
    <div class="footer">
        <span>© 2017 琼海市爱国卫生办公室 版权所有 </span>
        <span>技术支持： 琼海视窗</span>
    </div>
</div>
</body>
</html>


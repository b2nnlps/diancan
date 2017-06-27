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
    <link href="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body style=" background-color:#F4F5F6;">
<div class="box">
    <div class="Favorites">
        <ul>
            <li>
                <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['news/bl/add'])?>">
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/icon/add.png" width="30" height="30">
                </a>
            </li>
            <p><a href="#">爆料列表</a></p>
         <!--            <li><a href="#"><img src="/bl_v1.0/icon/gr.png" width="30" height="30"></a></li>-->
            <div class="clear"></div>
        </ul>
    </div>
    <div class="blank"></div>
    <!---->
    <div class="mian">
        <?php
        foreach ($fbModel as $_v) {
            $id=$_v['id'];
            $title=$_v['title'];
            $contentImg=preg_replace("/<img.*?>/si","",$_v['content']);
            $contentBr = preg_replace("/<br\s?\/?>/i","",$contentImg);
            $content=\common\models\ComModel::cut_str($contentBr,45);
            $time=date('Y-m-d',strtotime($_v['created_time']));
            $img=$_v['img'];
            if($img!=''){
                $imgUrl= explode(",", $img);
                $imgCount=count($imgUrl);
               if($imgCount>=1&&$imgCount<=2){?>
                     <div class="disclose_list clearfix">
                         <div class="list_img">
                             <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['news/bl/detail','id'=>$id]) ?>">
                                 <img src="<?=Yii::$app->view->theme->baseUrl.$imgUrl['0']?>">
                             </a>
                         </div>
                         <div class="list_text">
                             <ul>
                                 <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['news/bl/detail','id'=>$id])?>">
                                     <li><span><?=$title?></span></li>
                                     <li><?=$content?></li>
                                     <li><img src="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/icon/tiem.png" width="15" height="15"><em><?=$time?></em></li>
                                 </a>
                             </ul>
                         </div>
                     </div>
               <?php }else if($imgCount>=3){?>
                     <div class="disclose_list2">
                         <div class="list_text2">
                             <ul>
                                 <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['news/bl/detail','id'=>$id])?>">
                                     <li><span><?=$title?></span></li>
                                     <li><?=$content?></li>
                                     <li><img src="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/icon/tiem.png" width="15" height="15"><em><?=$time?></em></li>
                                 </a>
                             </ul>
                         </div>
                         <div class="list_img2">
                             <ul class="clearfix">
                                 <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['news/bl/detail','id'=>$id])?>">
                                      <?php
                                     for($i=0;$i<3;++$i){
                                     ?>
                                     <li><img src="<?=Yii::$app->view->theme->baseUrl.$imgUrl[$i]?>"></li>
                                     <?php  }?>
                                 </a>
                             </ul>
                         </div>
                     </div>
                 <?php  }  }else{?>
            <div class="disclose_list1">
                <div class="list_text1">
                    <ul>
                        <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['news/bl/detail','id'=>$id])?>">
                            <li><span><?=$title?></span></li>
                            <li><?=$content?></li>
                            <li><img src="<?= Yii::$app->view->theme->baseUrl ?>/bl_v1.0/icon/tiem.png" width="15" height="15"><em><?=$time?></em>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        <?php } } ?>
     <!--分页器：开始-->
        <div class="digg">
            <?php if($cnt==0){
                echo '暂无数据！';
            } else {
                echo $page_list;
            }?>
        </div>
        <!--分页器：结束-->

    </div>
    <!--页脚-->
    <div class="footer">
         <span>© <?=date('Y')?> 琼海市爱国卫生办公室 版权所有</span>
         <span>技术支持： 琼海视窗</span>
    </div>
</div>
</body>
</html>


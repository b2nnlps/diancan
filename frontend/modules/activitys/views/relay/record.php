<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-14
 * Time: 16:13
 */

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合微助力</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/css/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/js/jquery.min.js"></script>
    <script language="javascript">
        function woaicssq(num){
            for(var id = 1;id<=2;id++)
            {
                var MrJin="woaicss_con"+id;
                if(id==num)
                    document.getElementById(MrJin).style.display="block";
                else
                    document.getElementById(MrJin).style.display="none";
            }
            var zzsc = $(".But_in a");
            zzsc.click(function(){
                $(this).addClass("thisclass").siblings().removeClass("thisclass");
            });
        }
        $(function(){
            var zzsc = $(".But_in a");
            zzsc.click(function(){
                $(this).addClass("thisclass").siblings().removeClass("thisclass");
            });
        });
    </script>
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/icon/return.png"></a></li>
            <p>助力记录</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="contentbox">
        <div class="personage">
            <ul>
                <li><span>参赛人：</span><?=$relayApplicant['name']?></li>
                <li><span>参赛时间：</span><?=$relayApplicant['datetime']?></li>
                <li><span>手机号码：</span><?php
                    $mobile=$relayApplicant['mobilephone'];
                    if(strlen($mobile)>=6){
                        $mobile[strlen($mobile)-3]='*';
                        $mobile[strlen($mobile)-4]='*';
                        $mobile[strlen($mobile)-5]='*';
                        $mobile[strlen($mobile)-6]='*';
                        $mobile[strlen($mobile)-7]='*';
                    }
                    echo $mobile;?>
                   </li>
                <li><span>公里数：</span><?=$relayApplicant['point']?>公里</li>
            </ul>
        </div>
        <div class="Chika">
            <div class="But_in">
                <a href="javascript:void(-1);" onclick="woaicssq(1)" id="woaicsstitle" class="thisclass">为我助力记录[最新100条]</a>
                <a href="javascript:void(-1);" onclick="woaicssq(2)" id="woaicsstitle" class="">获奖名单[最新100条]</a>
            </div>
        </div>
        <div id="woaicss_con1" style="display:block;">
            <div class="record">
                <ul>
                    <li style=" background-color:#E6E6E6">
                        <span class="xh">序号</span>
                        <span class="zlz">助力值</span>
                        <span class="mz">来自</span>
                        <span class="sj">时间</span>
                        <div class="clear"></div>
                    </li>
                    <?php
                        foreach ($relayRecord as $_k=>$_v){
                    ?>
                    <li>
                        <span class="xh"><?=$_k+1?></span>
                        <span class="zlz"><?=$_v['point']?></span>
                        <span class="mz"><?=\backend\modules\sys\models\WechatUser::getNickname($_v['from_user'])?></span>
                        <span class="sj"><?=$_v['date']?></span>
                        <div class="clear"></div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!--分页器：开始-->
<!--            <div class="pageNumber">-->
<!--                <ul>-->
<!--                    <li><a href="#">上一页</a></li>-->
<!--                    <li><a style=" border:1px solid #00A468; color:#00A468;" href="#">1</a></li>-->
<!--                    <li><a href="#">2</a></li>-->
<!--                    <li><a href="#">...</a></li>-->
<!--                    <li><a href="#">5</a></li>-->
<!--                    <li><a href="#">下一页</a></li>-->
<!--                    <div class="clear"></div>-->
<!--                </ul>-->
<!--            </div>-->
            <!--分页器：结束-->
        </div>
        <!---  --->

        <div id="woaicss_con2" style="display:none;">
            <div class="annotation">*请中奖的朋友凭手机号码和知豆码到相应赞助商领奖处，领取相应奖品！</div>
            <div class="record">
                <ul>
                    <li style="background-color:#E6E6E6">
                        <span class="xh">序号</span>
                        <span class="zlz">获奖者</span>
                        <span class="mz">赞助商</span>
                        <span class="sj">时间</span>
                        <div class="clear"></div>
                    </li>
                    <?php
                         foreach ($relayAwards as $_k=>$_v){
                        ?>
                        <li>
                            <span class="xh"><?=$_k+1?></span>
                            <span class="zlz"><?=$_v['name']?></span>
                            <span class="mz"><?=$_v['sponsor_name']?></span>
                            <span class="sj"><?=$_v['win_time']?></span>
                            <div class="clear"></div>
                        </li>
                    <?php } ?>
                </ul>
<!--                <a href="#">加载更多</a>-->
            </div>
        </div>
    </div>
</div>
</body>
</html>


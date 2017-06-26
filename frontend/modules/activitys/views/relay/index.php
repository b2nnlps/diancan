<?php
use yii\helpers\Html;
use backend\modules\activitys\models\RelayApplicant;

$jssdk = new \common\wechat\JSSDK();
$signPackage = $jssdk->GetSignPackage();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta content="telephone=no" name="format-detection">
    <title>容合微助力</title>
    <?= \yii\helpers\Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/css/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/js/jquery.touchSlider.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/js/pictures.js"></script>
    <script>
         /**
         * 转发封面及简介
         * @returns {undefined}
         */
        var id="<?=$relayactivity['id']?>";//项目活动ID
        var  now_openid="<?=isset($_GET['openid'])?$_GET['openid']:$wechat_openid?>";
        var dataForShare={
            weixin_icon:"<?=$relayactivity['imgurl']?>",
            weixin_url:"http://ms.n39.cn/activitys/relay/index?openid="+now_openid,
            weibo_icon:"<?=$relayactivity['imgurl']?>",
            url:"http://ms.n39.cn/activitys/relay/index?openid="+now_openid,
            title:"<?= $relayactivity['send_title']?>",
           description:"<?=strip_tags($relayactivity['send_detail'])?>快来为好友<?= RelayApplicant::getName(isset($_GET['openid'])?$_GET['openid']:$wechat_openid,$relayactivity['id'])?>助力吧！"
        };
    </script>
 <style>#ceng img{ width: 100%;}</style>
</head>

<body style="background-color:#3BD276;">

<div class="box">
    <div class="head">
        <!--图片轮播 -->
        <!--效果html开始-->
        <div class="main_visual">
            <div class="flicking_con">
                <?php
                $link=\backend\modules\sys\models\Link::find()->where(['c_id'=>3,'status'=>1])->limit(10)->orderBy('')->all();
                foreach ($link as $_k=>$_v){
                ?>
                <a href="#"><?=$_k?></a>
                <?php } ?>
            </div>
            <div class="main_image">
                <ul>
                    <?php
                    foreach ($link as $_v){
                    ?>
                    <li><span><a href="<?=$_v['url']?>"><img src="<?=$_v['img']?>"></a></span></li>
                    <?php } ?>
                </ul>
                <a href="javascript:;" id="btn_prev"></a>
                <a href="javascript:;" id="btn_next"></a>
            </div>
        </div>

        <!--效果html结束-->
    </div>
    <div class="logo"><img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/images/img1.png"></div>
    <div class="Pageview">
        <img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/images/img2.png">
        <div class="activity_time">活动时间： <?=date("Y.m.d H:i",strtotime($relayactivity['start_time']))?>至<?=date("Y.m.d H:i",strtotime($relayactivity['end_time']))?></div>
        <div class="browse"><span>预览量：<?=$relayactivity['visit']?></span></div>
        <div class="time">
            <span>
             <!--倒计时-->
            <div class="time-item">
                <span id="day_show">0天</span>
                <strong id="hour_show">0时</strong>
                <strong id="minute_show">0分</strong>
                <strong id="second_show">0秒</strong>
            </div>
                <!--倒计时模块-->
            </span>
        </div>
    </div>
    <div class="participantbox">
        <img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/images/img3.png">
        <div class="participant">
            <h4>参赛人</h4>
             <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['activitys/relay/record','openid'=>$relayApplicant['wechat_id']])?>">
            <span><?=$relayApplicant['name']?>
                <?php
                $mobile=$relayApplicant['mobilephone'];
                if(strlen($mobile)>=6){
                    $mobile[strlen($mobile)-3]='*';
                    $mobile[strlen($mobile)-4]='*';
                    $mobile[strlen($mobile)-5]='*';
                    $mobile[strlen($mobile)-6]='*';
                    $mobile[strlen($mobile)-7]='*';
                }
                echo $mobile;?> 
				  <em style="color: #f7f7f7;font-weight: bold;">[ 查看记录 ]</em>
                </span>
            </a>
        </div>
       <a class="one" href="javascript:showBg6();" onclick="transfer(1)">100</a>
        <a class="two" href="javascript:showBg6();" onclick="transfer(2)">300</a>
        <a class="three" href="javascript:showBg6();" onclick="transfer(3)">500</a>
        <a class="four" href="javascript:showBg6();" onclick="transfer(4)">800</a>
        <a class="five" href="javascript:showBg6();" onclick="transfer(5)">1000</a>
        <a class="six" href="javascript:showBg6();" onclick="transfer(6)">5000</a>
    </div>
    <div id="indianaNumber">
        <div class="indianaNumber">
            <div class="divimg"><img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/images/img7.png" width="275" height="70"></div>
            <div class="cd-buttons">
               <ul>
                    <li><em>赞助商：</em><span id="zzs"></span><div class="clear"></div></li>
                    <li><em>奖品：</em><span id="sp"></span><div class="clear"></div></li>
                    <img id="zzsimg" src="#">
                </ul>
            </div>
        </div>
        <a href="#0" class="cd-popup-close" onclick="closeBg()"></a>
    </div>
    <div class="join">
        <img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/images/img4.png">
        <div class="kilometre">
            <ul>
                <li><img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/images/img6.png"></li>
                <li style="width:40%"><span><?=$relayApplicant['point']?></span>公里</li>
                <li><img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/images/img6.png"></li>
                <div class="clear"></div>
            </ul>
        </div>
            <?php
        $now_time=strtotime(date('Y-m-d H:i:s')); //当前时间
        $start_time=strtotime($relayactivity['start_time']); //活动开始时间
        $end_time=strtotime($relayactivity['end_time']); //活动结束时间
        if($start_time>$now_time){//活动尚未开始
            $fx='onclick="check()"';
            $myzl='';
            $left_icon='<img src="'.Yii::$app->view->theme->baseUrl.'/relay_v1/icon/medazrcz.png">';

            $right_img='start';
        }elseif ($end_time<$now_time){//活动已结束
            $fx='onclick="check()"';
            $myzl='';
            $left_icon='<img src="'.Yii::$app->view->theme->baseUrl.'/relay_v1/icon/medazrcz.png">';
            $right_img='end';
        }else{
            $right_img='medal7';
            if($isApplicant==0){//我要参赛
                $fx='';
                $myzl='myzl';
                $left_icon='<img src="'.Yii::$app->view->theme->baseUrl.'/relay_v1/icon/medal6.png">';
            }else{
                $openid=isset($_GET['openid'])?$_GET['openid']:$wechat_openid;
                if($openid==$wechat_openid){//找人充电
                    $fx='onclick="check()"';
                    $myzl='';
                    $left_icon='<img src="'.Yii::$app->view->theme->baseUrl.'/relay_v1/icon/medazrcz.png">';
                }else{//返回我的首页
                    $fx='';
                    $myzl='';
                    $myUrl=Yii::$app->urlManager->createAbsoluteUrl(['activitys/relay/index','openid'=>$wechat_openid]);
                    $left_icon='<a href="'.$myUrl.'"><img src="'.Yii::$app->view->theme->baseUrl.'/relay_v1/icon/myhome.png"></a>';
                }
            }
        } ?>
            <div id="<?=$myzl?>" class="play login-header" <?=$fx?>>
                    <?=$left_icon?>
            </div>
        <div id="apply">
            <div id="toph"><span>微助力报名入口</span> <div class="clear"></div></div>
            <ul>
                <li><em>姓名</em><i><input type="text" class="name" placeholder="请您输入姓名"/></i></li>
                <li><em>手机</em><i><input type="text" class="phone" placeholder="请您输入手机号码"/></i></li>
                <div id="btnbm"><input type="submit" value="确认提交" class="submitBtn" /></div>
            </ul>
        </div>

       <div id="reminder" class="refuel login-header-one"><a href="javascript:void(0);"><img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/icon/<?=$right_img?>.png"></a></div>
<!--        <div class="login">-->
<!--            <div class="login-title">报名参赛<span><a href="javascript:void(0);" class="close-login"><img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/relay_v1/icon/medal8.png"></a></span></div>-->
<!--            <div class="login-input-content">-->
<!--                <div class="login-input">-->
<!--                    <label>姓名：</label>-->
<!--                    <input type="text" placeholder="请输入您的姓名"  name="info[username]" id="username" class="list-input"/>-->
<!--                </div>-->
<!--                <div class="login-input">-->
<!--                    <label>手机号：</label>-->
<!--                    <input type="text" placeholder="请输入您的手机号码" name="info[phone]" id="phone" class="list-input"/>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="login-button"><a href="javascript:void(0);" class="submitBtn" id="login-button-submit">提交</a></div>-->
<!--        </div>-->
    </div>



    <div class="login-one">
        <div class="login-title small">
            <span>
                <a href="javascript:void(0);" class="close-login">
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/icon/medal9.png">
                </a>
            </span>
        </div>
        <h3>充 电 成 功！</h3>
    </div>
    <div class="login-bg"></div>
    <div class="rankingbox">
        <div class="Chika">
            <div class="Chikafusa"><a href="javascript:void(-1);" onclick="woaicssq(1)" id="woaicsstitle" class="thisclass">参赛人员（<?=$zrs_count?>人）</a> <a href="javascript:void(-1);" onclick="woaicssq(2)" id="woaicsstitle" class="">参赛规则</a> </div>
        </div>
        <div id="woaicss_con1" style="display:block;">
            <img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/images/img5.png">
            <div class="ranking">
                <ul>
                    <li><span style="font-size:16px;color:#FFF;" class="xh">序号</span><span style="font-size:16px;color:#FFF;" class="xm">姓名</span><span style="font-size:16px; color:#FFF;" class="sjh">手机号</span><span style="font-size:16px; color:#FFF;" class="zlz">助力值</span></li>
                    <?php
                    foreach($applicants as $_k=>$_v){
                        if($_k<=2){
                            $listColor="color:#ffd200;";
                        }else{
                            $listColor="#";
                        }
                    ?>
                    <li style="<?=$listColor?>">
                        <span class="xh">
                            <?php
                            if($_k<=2){
                                if($_k==0){
                                    $iconimg='1';
                                }elseif($_k==1){
                                    $iconimg='2';
                                }elseif($_k==2){
                                    $iconimg='3';
                                }
                            ?>
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/icon/medal<?=$iconimg?>.png" width="28" height="33">
                            <?php }else{
                                echo $_k+1;
                            }?>
                        </span>
                        <span class="xm"><?=$_v['name']?></span>
                        <span class="sjh"><?php
                            $mobile=$_v['mobilephone'];
                            if(strlen($mobile)>=6){
                                $mobile[strlen($mobile)-3]='*';
                                $mobile[strlen($mobile)-4]='*';
                                $mobile[strlen($mobile)-5]='*';
                                $mobile[strlen($mobile)-6]='*';
                                $mobile[strlen($mobile)-7]='*';
                            }
                            echo $mobile;?></span>
                        <span class="zlz"><?=$_v['point']?></span>
						<div class="clear"></div>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <div id="woaicss_con2" style="display:none;">
            <div class="inlinebox">
                <div class="rules">
                  <?=$relayactivity['content']?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--点击后出现遮罩层 并且有图片指向-->
<div onclick="checkhd()" id="ceng" style="display:none; position:fixed; top:0px; left:0px; background-color:black; width:100%; height:100%; filter:alpha(opacity=80);-moz-opacity:0.80;opacity:0.80;">
    <div style="width:100%; height:100%;color:white;margin:auto; text-align:center;"><img src="<?=Yii::$app->request->baseUrl?>/relay_v1/icon/fx.png"></div>
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
        var $el = $('.dialog');
        $('#myzl').hDialog({box: '#apply',boxBg: '#eeeeee',width:300,height: 220});//注意：请将要放入弹框的内容放在比如id="HBox"的容器中，然后将box的值换成该ID即可，比如：$(element).hDialog({'box':'#HBox'});
        $.goTop('45px','2px');//返回顶部,(参数1：和屏幕底部的距离，参数2：和屏幕右侧的距离； PS:自定义一定要加单位，比如px,em, 也可以是百分比哦)

         var checkSubmitFlg = false;
        $('.submitBtn').click(function() {//提交报名并验证表单
            if (!checkSubmitFlg) {
                var csrfName = $('meta[name=csrf-param]').prop('content');
                var crsfToken = $('meta[name=csrf-token]').prop('content');
                var PhoneReg =/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/; //手机正则
                var $name = $('.name');
                var $phone = $('.phone');
                var ac_id=<?=$id?>;
                if($name.val() === ''){
                    $.tooltip('姓名还没填呢...'); $name.focus();
                }else if($phone.val() === ''){
                    $.tooltip('手机还没填呢...'); $phone.focus();
                }else if(!PhoneReg.test($phone.val())){
                    $.tooltip('手机格式错咯...'); $phone.focus();
                }else{
                    var data =csrfName + '='+crsfToken+"&activity_id="+ac_id+"&name="+$name.val()+"&phone="+$phone.val();
    //                alert(data);
                    if (!checkSubmitFlg) {
                        checkSubmitFlg = true;// 第一次提交
                        $.post("<?=\yii\helpers\Url::to(['relay/applicants'])?>", data, function (result) {
                            if(result!==''){
                                $.dialog( 'alert','温馨提示', result, 4000,true);
                            }else{
                                $.tooltip('正在提交，请稍后！2秒后自动关闭。。。。',2000,true,function(){
                                    $el.hDialog('close',{box:'#apply'},'index?openid='+'<?=$wechat_openid?>'); //报名提交后跳转链接
                                });
                            }
                        });

                    }
                }
                return true;
            } else {
                //重复提交
                $.tooltip('请勿重复提交！');
                return false;
            }

        });
    });
</script>
<script type="text/javascript">
    //alert:为好友助力提示
	 var checkSubmitFlg = false;
    $('#reminder').click(function(){
        if (!checkSubmitFlg) {
            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');
            var data =csrfName + '='+crsfToken+"&activity_id="+'<?=$id?>'+"&to_user="+'<?=isset($_GET['openid'])?$_GET['openid']:$wechat_openid?>';
            //      alert(data);
            if (!checkSubmitFlg) {
                checkSubmitFlg = true;// 第一次提交
                $.post("<?=\yii\helpers\Url::to(['relay/pointsave'])?>", data, function (result) {
                    $.dialog('confirm','提示',result,0,function(){
                        window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['activitys/relay/index','openid'=>isset($_GET['openid'])?$_GET['openid']:$wechat_openid])?>";
                    });
                });
            }
            return true;
        } else {
            //重复提交
            $.tooltip('请勿重复提交！');
            return false;
        }
    });
/**
     * 显示或隐藏转发提示
     * @returns {undefined}
     */
    function check(){
        document.getElementById("ceng").style.display = "block";//显示转发提示
    }
    function checkhd(){
        document.getElementById("ceng").style.display = "none";//隐藏转发提示
    }
</script>
<script>
function transfer(id) {
    if (id == 1) {
        document.getElementById("zzs").innerHTML = "小二租车";
        document.getElementById("sp").innerHTML = "价值177元租车大礼包";
        document.getElementById("zzsimg").src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/icon/xebc.png";
        
    }
    if (id == 2) {
        document.getElementById("zzs").innerHTML = "源谷食代";
        document.getElementById("sp").innerHTML = "价值39.8元的小麦胚芽";
        document.getElementById("zzsimg").src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/icon/ygsd.jpg";
       
    }
    if (id == 3) {
        document.getElementById("zzs").innerHTML = "瑞塔";
        document.getElementById("sp").innerHTML = "意式餐吧：价值68元会员卡，持卡进店消费可享8.8折。";
        document.getElementById("zzsimg").src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/icon/rtyscb.png";
       
    }
    if (id == 4) {
        document.getElementById("zzs").innerHTML = "勇易改";
        document.getElementById("sp").innerHTML = "赛车改装工坊大礼包";
        document.getElementById("zzsimg").src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/icon/yyg.png";
        
    }
    if (id == 5) {
        document.getElementById("zzs").innerHTML = "幸福里";
        document.getElementById("sp").innerHTML = "奖品大礼包";
        document.getElementById("zzsimg").src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/icon/xfl.jpg";

    }
	  if (id == 6) {
        document.getElementById("zzs").innerHTML = "知豆汽车海甸岛体验店";
        document.getElementById("sp").innerHTML = "终极大奖";
        document.getElementById("zzsimg").src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/icon/zd.png";
    }
}
</script>

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    /**
     * 转发调用
     * @returns {undefined}
     */
    var  debug_t=false;
    var wx_config_t={
        debug: debug_t,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
        ]
    };
    wx.config(wx_config_t);
    var onBridgeReady_new;
    wx.ready(function (){
        onBridgeReady_new=function(){
            wx.onMenuShareAppMessage({
                title: dataForShare.title,
                desc: dataForShare.description,
                link: dataForShare.weixin_url,
                imgUrl: dataForShare.weixin_icon,
                //   trigger: function (res) {_shareInWeixin._hideFromJsBridge();/*alert('用户点击发送给朋友');*/},
                success: function (res) {
                    //    (dataForShare.callback)();
                    //alert("谢谢您的分享。");
                },
                cancel: function (res) {/*alert('已取消');*/},
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });
            wx.onMenuShareTimeline({
                title: dataForShare.description,
                link: dataForShare.weixin_url,
                imgUrl: dataForShare.weixin_icon,
                //    trigger: function (res) {_shareInWeixin._hideFromJsBridge();/*alert('用户点击分享到朋友圈');*/},
                success: function (res) {
                    // (dataForShare.callback)();

                },
                cancel: function (res) {/*alert('已取消');*/},
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });
            wx.onMenuShareQQ({
                title: dataForShare.title,
                desc: dataForShare.description,
                link: dataForShare.weixin_url,
                imgUrl: dataForShare.weixin_icon,
                // trigger: function (res) {_shareInWeixin._hideFromJsBridge();},
                complete: function (res) {
                    //alert(JSON.stringify(res));
                },
                //  success: function (res) {(dataForShare.callback)();},
                cancel: function (res) {/*alert('已取消');*/},
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });
            wx.onMenuShareWeibo({
                title: dataForShare.title,
                desc: dataForShare.description,
                link: dataForShare.weixin_url,
                imgUrl: dataForShare.weixin_icon,
                //  trigger: function (res) {_shareInWeixin._hideFromJsBridge();/*alert('用户点击分享到微博');*/},
                complete: function (res) {
                    //alert(JSON.stringify(res));
                },
                //   success: function (res) {(dataForShare.callback)();},
                cancel: function (res) {/*alert('已取消');*/},
                fail: function (res) {
                    //alert(JSON.stringify(res));
                }
            });
        }
        onBridgeReady_new();
    });
</script>
<script type="text/javascript">
    /**
     * 倒计时js
     * @returns {undefined}
     */
        <?php
        $now_time=strtotime(date('Y-m-d H:i:s')); //当前时间
        $start_time=strtotime($relayactivity['start_time']); //活动开始时间
        $end_time=strtotime($relayactivity['end_time']); //活动结束时间
        $surplus=ceil($end_time-$now_time); //距离活动结束时间倒计时=活动结束时间戳-当前时间戳
        ?>
    var intDiff = parseInt(<?=$surplus?>);//倒计时总秒数量
    function timers(intDiff){
        window.setInterval(function(){
            var day=0,
                hour=0,
                minute=0,
                second=0;//时间默认值
            if(intDiff > 0){
                day = Math.floor(intDiff / (60 * 60 * 24));
                hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
                minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
                second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            }
            if (minute <= 9) minute = '0' + minute;
            if (second <= 9) second = '0' + second;
            $('#day_show').html(day+"天");
            $('#hour_show').html('<s id="h"></s>'+hour+'时');
            $('#minute_show').html('<s></s>'+minute+'分');
            $('#second_show').html('<s></s>'+second+'秒');
            intDiff--;
        }, 1000);
    }
    $(function(){
        timers(intDiff);
    });
</script>
    <script type="text/javascript">
        /*弹框JS内容*/
        function showBg6() {
            $("#indianaNumber").show();
            $(".login-bg").show();
        }
        //关闭弹出框
        function closeBg() {
            $("#indianaNumber").hide();
            $(".login-bg").hide();
        }
    </script>
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
        var zzsc = $(".Chikafusa a");
        zzsc.click(function(){
            $(this).addClass("thisclass").siblings().removeClass("thisclass");
        });
    }
    $(function(){
        var zzsc = $(".Chikafusa a");
        zzsc.click(function(){
            $(this).addClass("thisclass").siblings().removeClass("thisclass");
        });
    });
</script>

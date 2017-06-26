<?php
    use yii\helpers\Html;
    use backend\modules\activitys\models\RelayApplicants;
    use common\wechat\JSSDK;
    $jssdk = new JSSDK();
    $signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?= Html::csrfMetaTags()?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>容合微助力</title>

<link rel="stylesheet" href="<?=Yii::$app->request->baseUrl?>/activitys/css/style.css" />
<link rel="stylesheet" href="<?=Yii::$app->request->baseUrl?>/activitys/css/animate.css"/> <!-- 动画效果 -->
<link rel="stylesheet" href="<?=Yii::$app->request->baseUrl?>/activitys/css/common.css"/><!-- 页面基本样式 -->
 <script>
/**
 * 转发封面及简介
 * @returns {undefined}
 */
        var id="<?=$model['id']?>";//项目活动ID
        var  now_openid="<?=isset($_GET['openid'])?$_GET['openid']:$wechatId?>";
        var dataForShare={
            weixin_icon:"<?=$model['imgurl']?>",
            weixin_url:"http://micro.n39.cn/activitys/relay/index?id="+id+"&openid="+now_openid,
            weibo_icon:"<?=$model['imgurl']?>",
            url:"http://micro.n39.cn/activitys/relay/index?id="+id+"&openid="+now_openid,
            title:"<?= $model['send_title']?>",
            description:"<?=strip_tags($model['send_detail'])?>快来为好友<?= RelayApplicants::getUser(isset($_GET['openid'])?$_GET['openid']:$wechatId)?>助力吧！"
        };
    </script>
</head>

<body>
<div class="wrapper"> 
  <!--头部信息：开始-->
  <div class="topConten">
    <div class="topmessage"> <img src="<?=$model['imgurl']?>">
      <h1>
        <?=$model['title']?>
      </h1>
      <h2>活动时间：
        <time>
          <?=date("Y.m.d H:i",strtotime($model['start_time']))?>至
          <?=date("Y.m.d H:i",strtotime($model['end_time']))?>
        </time>
      </h2>
      <h1>浏览次数： <?=$model['visit']?></h1>
    </div>
    
    <!--倒计时-->
    <div class="time-item"> <span id="day_show">0天</span> <strong id="hour_show">0时</strong> <strong id="minute_show">0分</strong> <strong id="second_show">0秒</strong> </div>
    <!--倒计时模块--> 
    <!--具体详情--->
    <div class="editor">
      <?=$model['content']?>
    </div>
  </div>
  <!--头部信息：结束--> 
  
  <!--数据列表：开始--->
  <div class="dataTable">
    <span> <em>TOP 50</em> <cite>报名人数:<?=$zrs_count?> </cite> <div class="clear"></div></span>
    <div class="myBox"> <b id="zhuli_point">我的助力值：<?=$point?></b> <i id="zhuli_rank">我的排名：<?=$rank?></i><div class="clear"></div></div>
    <table id="options">
      <thead>
        <tr>
          <th style="width: 25px">序号</th>
          <th>姓名</th>
          <th style="width:35px">手机号</th>
          <th><div style="width:60px; color: #ffffff;" id="refresh">助力值<br>(点击刷新)</div></th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $i=1;
           foreach ($applicants as $_v ): 
         ?>
        <tr>
          <td><strong><?=$i?></strong></td>
          <td><?=$_v['name']?></td>
          <td><?php
                 $mobile=$_v['mobilephone'];
                 if(strlen($mobile)>=6){
                    $mobile[strlen($mobile)-3]='*';
                    $mobile[strlen($mobile)-4]='*';
                    $mobile[strlen($mobile)-5]='*';
                    $mobile[strlen($mobile)-6]='*';
                    $mobile[strlen($mobile)-7]='*';
                  }
                 echo $mobile;?>
          </td>
          <td><?=$_v['point']?></td>
        </tr>
        <?php
            $i++;
            endforeach;
        ?>
      </tbody>
    </table>
  </div>
  <!--数据列表：结束---> 
</div>
<?php 
       $now_time=strtotime(date('Y-m-d H:i:s')); //当前时间
       $start_time=strtotime($model['start_time']); //活动开始时间
       $end_time=strtotime($model['end_time']); //活动结束时间
       if($start_time>$now_time){
?>
    <div class="suspension">
      <div class="period"> 
       <button class="periodbtn">活动尚未开始 </button>
      </div>
    </div>
<?php }elseif ($end_time<$now_time){?>
      <div class="suspension">
      <div class="period"> 
        <button class="periodbtn">活动已经结束 </button>
      </div>
    </div>
<?php }else{ ?>
    <div id="neil1" <?php if($pd==0){ echo 'style="display:none"';}?>>
      <div class="suspension">
        <div class="qh">
          <?php
            if($pd==1){//如果传过来的openid和这个用户的openid相同或传过来的openid为空时
                $onclick='yinc(8)';//让他不能点击切换
            }else{$onclick='yinc(1)';}?>
          <button class="btn03" onclick="<?=$onclick?>">切换至好友 </button>
        </div>
        <?php if($isbm==1){?><!--如果已经报名-->
            <div> <a href="#" class="myreminder wobble"><button class="btn01">为我助力 </button></a></div>
            <div> <a href="#" onclick="check()"><button class="btn02">找朋友为我助力</button></a></div>
        <?php } else { ?>
             <div class="mybm"> <a href="#" class="myzl wobble"><button class="btn04">我要报名助力</button></a></div>
        <?php }?>
      </div>
    </div>
    
    <div id="neil2" <?php if($pd==1){ echo 'style="display:none"';}?>>
      <div class="suspension">
        <div class="qh"><button class="btn03" onclick="yinc(2)">切换至我 </button></div>
        <div> <a href="#" class="reminder wobble"><button class="btn01">为好友点赞助力 </button> </a></div>
        <div> <a href="#" onclick="check()"><button class="btn02">分享好友的助力</button></a></div>
      </div>
    </div>
<?php }?>
<div id="apply">
  <div id="toph"><span>微助力报名入口</span> <div class="clear"></div></div>
  <ul>
    <li><em>姓名</em><i><input type="text" class="name" placeholder="请您输入姓名"/></i></li>
    <li><em>手机</em><i><input type="text" class="phone" placeholder="请您输入手机号码"/></i></li>
    <div id="btnbm"><input type="submit" value="确认提交" class="submitBtn" /></div>
  </ul>
</div>
<!--点击后出现遮罩层 并且有图片指向-->
<div onclick="checkhd()" id="ceng" style="display:none; position:fixed; top:0px; left:0px; background-color:black; width:100%; height:100%; filter:alpha(opacity=30);-moz-opacity:0.30;opacity:0.30;">
  <div style="width:100%; height:100%;color:white;margin:auto 0px; text-align:center;"><img src="<?=Yii::$app->request->baseUrl?>/activitys/images/fx.png"></div>
</div>
<script src="<?=Yii::$app->request->baseUrl?>/activitys/js/jquery.min.js"></script> 
<script src="<?=Yii::$app->request->baseUrl?>/activitys/js/jquery.hDialog.js"></script>
</body>
</html>


<script>
/**
 * 返回顶部，报名窗口，助力点赞提示
 * @returns {undefined}
 */
$(function(){
	var $el = $('.dialog');
	$('.myzl').hDialog({box: '#apply',width:300,height: 220});//注意：请将要放入弹框的内容放在比如id="HBox"的容器中，然后将box的值换成该ID即可，比如：$(element).hDialog({'box':'#HBox'}); 
	$.goTop('45px','2px');//返回顶部,(参数1：和屏幕底部的距离，参数2：和屏幕右侧的距离； PS:自定义一定要加单位，比如px,em, 也可以是百分比哦)
	$('.submitBtn').click(function() {//提交报名并验证表单
            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');
            var PhoneReg =/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/; //手机正则
	    var $name = $('.name');
            var $phone = $('.phone');
            if($name.val() === ''){
		$.tooltip('姓名还没填呢...'); $name.focus();
            }else if($phone.val() === ''){
		$.tooltip('手机还没填呢...'); $phone.focus();
            }else if(!PhoneReg.test($phone.val())){
		$.tooltip('手机格式错咯...'); $phone.focus();
            }else{
                var data =csrfName + '='+crsfToken+"&activity_id="+'<?= isset($_GET['id'])?$_GET['id']:1?>'+"&name="+$name.val()+"&phone="+$phone.val();
                $.post("<?=\yii\helpers\Url::to(['relay/applicants'])?>", data, function (result) {
                      $.tooltip('正在提交，请稍后！2秒后自动关闭。。。。',2000,true,function(){
                         $el.hDialog('close',{box:'#apply'},'index?id='+'<?=isset($_GET['id'])?$_GET['id']:1?>'+'&openid='+'<?=$wechatId?>'); //报名提交后跳转链接 
                       });  
                 });
            }
	});
});
</script>

<script type="text/javascript"> 
var friend_point=<?=$friend_point?>;
var friend_rank=<?=$friend_rank?>;
var my_zhuli=<?=$point?>;
var my_rank=<?=$rank?>;
var z_name="<?=RelayApplicants::getUser(isset($_GET['openid'])?$_GET['openid']:$wechatId)?>";
/**
 * 点击自由切换到我或好友的助力界面
 * @returns {undefined}
 */

 function yinc(id){
     if(id==1){
            document.getElementById("neil1").style.display = "none";
            document.getElementById("neil2").style.display = "block";
            now_openid="<?=isset($_GET['openid'])?$_GET['openid']:$wechatId?>";
            document.getElementById("zhuli_point").innerHTML="好友助力值 : "+friend_point;
            document.getElementById("zhuli_rank").innerHTML="好友排名 : "+friend_rank;
            z_name="<?=RelayApplicants::getUser(isset($_GET['openid'])?$_GET['openid']:$wechatId)?>";
      }
	
     if(id==2){
		 document.getElementById("neil1").style.display = "block";
		 document.getElementById("neil2").style.display = "none";
		 now_openid="<?=$wechatId?>";
		 document.getElementById("zhuli_point").innerHTML="我的助力值 : "+my_zhuli;
		 document.getElementById("zhuli_rank").innerHTML="我的排名 : "+my_rank;
		 z_name="<?=RelayApplicants::getUser($wechatId)?>";
		
	 }
	var activityid="<?=$model['id']?>";//项目活动ID     
	dataForShare={
            weixin_icon:"<?=$model['imgurl']?>",
            weixin_url:"http://micro.n39.cn/activitys/relay/index?id="+activityid+"&openid="+now_openid,
            weibo_icon:"<?=$model['imgurl']?>",
            url:"http://micro.n39.cn/activitys/relay/index?id="+activityid+"&openid="+now_openid,
            title:"<?= $model['send_title']?>",
            description:"<?=strip_tags($model['send_detail'])?>快来为好友"+z_name+"助力吧！"
        };
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
 }
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
<script type="text/javascript">  
 //alert:为好友助力提示
$('.reminder').click(function(){
    var csrfName = $('meta[name=csrf-param]').prop('content');
    var crsfToken = $('meta[name=csrf-token]').prop('content');
    var data =csrfName + '='+crsfToken+"&activity_id="+'<?=isset($_GET['id'])?$_GET['id']:1?>'+"&to_user="+'<?=isset($_GET['openid'])?$_GET['openid']:$wechatId?>';
    $.post("<?=\yii\helpers\Url::to(['relay/pointsave'])?>", data, function (result) 
    {
        if(result=='0'){
           $.dialog( 'alert','温馨提示', '成功为好友获得<em>1</em>助力值！', 3000,true); 
           friend_point++;
           yinc(1);
         }else if(result=='1') {
             $.dialog( 'alert','温馨提示', '<em>亲</em>，今天已经为该好友投过票了！请明天再来！', 3000,true); 
         }else if(result=='3') {
             $.dialog( 'alert','温馨提示', '<em>亲</em>，您已经为该好友点赞助力过！不能重复助力！', 3000,true); 
         }else if(result=='4') {
             $.dialog( 'alert','温馨提示', '成功为好友获得<em>1</em>助力值！', 3000,true);  
             friend_point++;
             yinc(1);
         }
       });
});
 //alert:为我自己助力提示
$('.myreminder').click(function(){
    var csrfName = $('meta[name=csrf-param]').prop('content');
    var crsfToken = $('meta[name=csrf-token]').prop('content');
    var data =csrfName + '='+crsfToken+"&activity_id="+'<?=isset($_GET['id'])?$_GET['id']:1?>'+"&to_user="+'<?=$wechatId?>';
    $.post("<?=\yii\helpers\Url::to(['relay/pointsave'])?>", data, function (result) 
    {
        if(result=='0'){ 
            $.dialog( 'alert','温馨提示', '成功为自己获得<em>1</em>助力值！', 3000,true); 
             my_zhuli++;
             yinc(2);
        }else if(result=='1'){
           $.dialog( 'alert','温馨提示', '<em>亲</em>，今天已经为自己点赞助力过！请明天再来！', 3000,true); 
        }else if(result=='3'){
           $.dialog( 'alert','温馨提示', '<em>亲</em>，您已经为自己点赞助力过了！不能重复助力！', 3000,true); 
        }else if(result=='4'){
           $.dialog( 'alert','温馨提示', '成功为自己获得<em>1</em>助力值！', 3000,true); 
             my_zhuli++;
             yinc(2);
        }          
    });
});    
</script>

<script type="text/javascript">  
//页面加载时绑定按钮点击事件
$(function(){    
    $("#refresh").click(function(){        
        refresh();    
    });});//点击按钮调用的方法
function refresh(){    
    window.location.reload();
}//刷新当前页面. 
</script>    
<script type="text/javascript">  
/**
 * 倒计时js
 * @returns {undefined}
 */
    <?php 
        $surplus=ceil($end_time-$now_time); //距离活动结束时间倒计时=活动结束时间戳-当前时间戳
     ?>
    var intDiff = parseInt(<?=$surplus?>);//倒计时总秒数量
    function timer(intDiff){
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
            timer(intDiff);
    });	
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
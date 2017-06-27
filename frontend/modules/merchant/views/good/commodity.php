<?php
use backend\modules\sys\models\WechatUser;
use backend\modules\merchant\models\Orderproduct;
$jssdk = new \common\wechat\JSSDK();
$signPackage = $jssdk->GetSignPackage();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
	 <?= \yii\helpers\Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/shop.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/js/jquery.touchSlider.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/js/pictures.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/js/message.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/js/jquery.spinner.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/js/fudong.js"></script>
    <script>
        /**
         * 转发封面及简介
         * @returns {undefined}
         */
        var dataForShare={
            weixin_icon:"<?=$product['thumb']?>",
            weixin_url:"http://ms.n39.cn/merchant/good/commodity?aid="+<?=$model['id']?>,
            weibo_icon:"<?=$product['thumb']?>",
            url:"http://ms.n39.cn/merchant/good/commodity?aid="+<?=$model['id']?>,
            title:"<?=$product['name']?>",
            description:"<?=$product['brief']?>"
        };
    </script>
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png" width="30" height="30"></a></li>
            <p><?=$product['name']?></p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <!--图片轮播 -->
        <!--效果html开始-->
        <div class="main_visual">
            <div class="flicking_con">
                <?php
                $img=explode(',',$product['image']);
                $imgCount=count($img);
                for($i=0;$i<$imgCount;$i++){
                    echo '<a href="#">'.$i.'</a>';
                }?>
            </div>
            <div class="main_image">
                <ul>
                    <?php
                    for($i=0;$i<$imgCount;$i++){
                        echo '<li><span><img src="'.$img[$i].'"></span></li>';
                    }?>
                </ul>
                <a href="javascript:;" id="btn_prev"></a>
                <a href="javascript:;" id="btn_next"></a>
            </div>
        </div>
        <!--效果html结束-->
        <div class="product">
            <h4><?=$product['name']?></h4>
            <h5>已售:<?=$model['sales']?><?=$product['sku']?></h5>
            <dl>
                <dt>￥<em class="price"><?=$model['price']?></em></dt>
<!--                <dd>-->
<!--                    <div class="gw_num">-->
<!--                        <em class="min">-</em>-->
<!--                        <input type="hidden" value="247" class="stock"/>-->
<!--                        <input type="text" value="0" class="num"/>-->
<!--                        <em class="add">+</em>-->
<!--                    </div>-->
<!--                </dd>-->
                <div class="clear"></div>
            </dl>
        </div>
        <div class="Business">
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['merchant/good/product-list', 'sid' => $supplier['id']]) ?>">
                <dl>
                    <dt>
                        <img src="<?=$supplier['logo']?>">
                    </dt>
                    <dd><h4><?=$supplier['name']?></h4>
                        <p><?=$supplier['brief']?$supplier['brief']:'感谢您来光顾我的微店，祝您购物愉快！';?></p>
                    </dd>
                    <div class="clear"></div>
                </dl>
            </a>
        </div>
        <div class="Chika">
            <div class="Chikafusa">
                <a href="javascript:void(-1);" onclick="woaicssq(1)" id="woaicsstitle" class="thisclass">商品详情</a>
                <a href="javascript:void(-1);" onclick="woaicssq(2)" id="woaicsstitle" class="">销售记录</a>
            </div>
        </div>
        <div id="woaicss_con1" style="display:block;">
            <div class="describe">
                <?=$product['content']?>
            </div>
        </div>
        <div id="woaicss_con2" style="display:none;">
		
            <div class="record">
			<?php
				$per=8;
                $product_id=$model['id'];
                $connection = Yii::$app->db;
                $sql = "select * from  {{%merchant_orderproduct}} where product_id=$product_id and status=10  order by id desc limit 0,$per";
                $command=$connection->createCommand($sql);
                $orderproduct=$command->queryAll();
                foreach ($orderproduct as $_v){
                    $rh_openid=$_v['rh_openid'];
                    $member=\backend\modules\merchant\models\Member::find()->where(['rh_openid'=>$rh_openid])->one();
                    $wx_openid=$member['wx_openid'];
                    $headimg=WechatUser::getHeadimgurl($wx_openid);
                    $nickname=WechatUser::getNickname($wx_openid);
                    ?>
                    <dl class="lists">
                        <dt><img src="<?=$headimg?>"></dt>
                        <dd>
                            <h4><?=$nickname?></h4>
                            <span> <?=$_v['time']?>&nbsp;&nbsp;订购：<?=$_v['number']?> <?=$_v['sku']?></span>
                        </dd>
                        <div class="clear"></div>
                    </dl>
                <?php } ?>
            </div>
            <?php 
            $count=count($orderproduct);
            if($count>=$per){
                $class='get_more';
                $wz='查看更多记录';
            }elseif ($count==0||$count==null){
                $class='null';
                $wz='暂无记录！';
            } else{
                $class='null';
                $wz='没有更多了';
            }
                ?>
            <div class="<?=$class?>"><?=$wz?></div>
			
        </div>
    </div>


<!--    <div class="bottomMenu">-->
<!--        <dl>-->
<!--            <dt>-->
<!--                <a href="#">-->
<!--                    <img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/merchant_v1.0/icon/wqw.png">共<span id="total">￥0</span>-->
<!--                </a>-->
<!--            </dt>-->
<!--            <dd class="buy_btn">立即下单</dd>-->
<!--            <div class="clear"></div>-->
<!--        </dl>-->
<!--        <div id="sing">0</div>-->
<!--    </div>-->
    <!--悬浮菜单：结束-->
    
    
    
</div>
<div class="person"><a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/index'])?>"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/count1.png"></a></div>
<div id="backToTop">
    <a href="javascript:;" onfocus="this.blur();" class="backToTop_a png"></a>
</div>
</body>
<script type="text/javascript">
    $(function () {
        $('.get_more').click(function () {
            if($(this).text()=='没有更多了'){return false;} //停止加载

            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');
            var list_num = $('.lists').length;  //获取当前总条数
            var amount = 8; //每次点击加载条数
            var product_id ='<?=$product_id?>';
            // alert(list_num);
//            $(this).text('').append("<img src='<?//=Yii::$app->view->theme->baseUrl?>///more/loader.gif'>");
            var data =csrfName + '='+crsfToken+"&list_num="+list_num+"&amount="+amount+"&product_id="+product_id;
            //  alert(data);
            $.post('<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/good/more'])?>',data, function (result){
                if(result=='not_more'){
                    $('.get_more').text('没有更多了');
                }else{
                    $('.get_more').text('查看更多记录');
                    $('.record').append(result);
                }
            })

        })
    })
</script>

</html>

<script src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/hDialog/js/jquery.hDialog.js"></script>
<script>
//    $(function(){
//        $('.box').mousedown(function(){
//            var t=$(this).parent().find('input[class*=num]');
//            var number=t.val(parseInt(t.val()));
//            var stock=parseInt($(this).parent().find('input[class*=stock]').val());
//            if(number.val()>stock){
//                $.tooltip('预订商品超出剩余数量！');
//                t.val(stock);
//            }
//            setTotal();
//        });
//
//        $(".add").click(function(){
//            var t=$(this).parent().find('input[class*=num]');
//            var number=t.val(parseInt(t.val())+1);
//            var stock=parseInt($(this).parent().find('input[class*=stock]').val());
//            if(number.val()>stock){
//                $.tooltip('预订商品超出剩余数量！');
//                t.val(stock);
//            }else{
//                setTotal();
//            }
//        });
//        $(".min").click(function(){
//            var t=$(this).parent().find('input[class*=num]');
//            t.val(parseInt(t.val())-1);
//            if(parseInt(t.val())<0){
//                t.val(0);
//            }
//            setTotal();
//        });
//        function setTotal(){
//            var n=0;
//            var s=0;
//            $(".product dl").each(function(){
//                n+=parseInt($(this).find('input[class*=num]').val());//parseInt() 函数可解析一个字符串，并返回一个整数。
//                s+=parseInt($(this).find('input[class*=num]').val()) *parseFloat($(this).find('em[class*=price]').text());
//            });
//            $("#sing").html(n);//数量
//            $("#total").html(s.toFixed(2));//总价，保留小数点后两位；toFixed() 方法可把 Number 四舍五入为指定小数位数的数字。
//        }
//        setTotal();
//
//        $('.buy_btn').click(function() {
//            var csrfName = $('meta[name=csrf-param]').prop('content');
//            var crsfToken = $('meta[name=csrf-token]').prop('content');
//            var number=$('.num');
//            if(number.val() ==='0'){
//                $.tooltip('您还没选择商品数量呢...'); number.focus();
//            }else{
//                $.dialog('confirm','提示','您确定要下单吗？',0,function(){
//                    var data =csrfName + '='+crsfToken+"&number="+number.val()+"&productid="+1;
//                    //                    alert(data);
//                    $.post("http://localhostorder/add-cart", data, function (result) {
//                        if(result!==''){
//                            $.dialog( 'alert','温馨提示', result, 4000,true);
//                        } else{
//                            window.location.href="http://localhostorder/cart?supplier_id=1";
//                        }
//                    });
//                });
//            }
//        });
//
//    });

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
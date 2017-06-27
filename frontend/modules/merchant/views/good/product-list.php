<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 20:25
 */

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
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/js/jquery.spinner.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/js/fudong.js"></script>
    <script>
        /**
         * 转发封面及简介
         * @returns {undefined}
         */
        var dataForShare={
            weixin_icon:"<?=$supplier['logo']?>",
            weixin_url:"http://ms.n39.cn/merchant/good/product-list?sid="+<?=$supplier['id']?>,
            weibo_icon:"<?=$supplier['logo']?>",
            url:"http://ms.n39.cn/merchant/good/product-list?sid="+<?=$supplier['id']?>,
            title:"<?=$supplier['name']?>",
            description:"<?=$supplier['brief']?$supplier['brief']:'感谢您来光顾我的微店，祝您购物愉快！';?>"
        };
    </script>
    <script language="javascript">
        $(function(){
            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');
            $(".add").click(function(){
                var t=$(this).parent().find('input[class*=num]');
                var productid=$(this).parent().find('input[class*=productid]');

                var number=t.val(parseInt(t.val())+1);
                var stock=parseInt($(this).parent().find('input[class*=stock]').val());
                if(number.val()>stock){
                    $.tooltip('预订商品超出剩余数量！');
                    var number=t.val(stock);
                }else{
                    setTotal();
                    var data =csrfName + '='+crsfToken+"&number="+number.val()+"&agentPid="+productid.val();
//                    alert(data);
                    $.post("<?=\yii\helpers\Url::to(['default/add-cart'])?>", data);
                }

            });
            $(".min").click(function(){
                var t=$(this).parent().find('input[class*=num]');
                var productid=$(this).parent().find('input[class*=productid]');
                var number=t.val(parseInt(t.val())-1);
                if(parseInt(t.val())<0){
                    t.val(0);
                }
                setTotal();
                var data =csrfName + '='+crsfToken+"&number="+number.val()+"&agentPid="+productid.val();
//                alert(data);
                $.post("<?=\yii\helpers\Url::to(['default/add-cart'])?>", data);
            });
            function setTotal(){
                var n=0;
                var s=0;
                $(".list dl").each(function(){
                    n+=parseInt($(this).find('input[class*=num]').val());//parseInt() 函数可解析一个字符串，并返回一个整数。
                    s+=parseInt($(this).find('input[class*=num]').val()) *parseFloat($(this).find('em[class*=price]').text());
                });
                $("#sing").html(n);//数量
                $("#total").html(s.toFixed(2));//总价，保留小数点后两位；toFixed() 方法可把 Number 四舍五入为指定小数位数的数字。
            }
            setTotal();

            $('.order').click(function() {
                var number=document.getElementById("sing").innerHTML;
                if(number==='0'){
                    $.tooltip('您还没选购商品呢...');
                }else{
                    window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/cart','sid'=>$sid])?>";
                }
            });

        })
    </script>
</head>

<body>
<div class="box"><!--头部：开始--->
    <!--<div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="icon/return1.png"></a></li>
            <p>容合商行</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>-->
    <div class="main" style=" margin-top:0;">
        <div class="list_top">
            <dl>
                <dt> <img src="<?=$supplier['logo']?>"></dt>
                <dd>
                    <h4><?=$supplier['name']?></h4>
                    <p><?=$supplier['brief']?$supplier['brief']:'感谢您来光顾我的微店，祝您购物愉快！';?></p>
                </dd>
                <div class="clear"></div>
            </dl>
        </div>
        <div class="Chika">
            <div class="Chikafusa">
                <a href="javascript:void(-1);" onClick="woaicssq(1)" id="woaicsstitle" class="thisclass">商品</a>
                <a href="javascript:void(-1);" onClick="woaicssq(2)" id="woaicsstitle" class="">商户详情</a>
            </div>
        </div>

        <div id="woaicss_con1" style="display:block;">
            <div class="list">


                <?php
                foreach ($agent as $_v){
                    $product_id=$_v['product_id'];
                    $product=\backend\modules\merchant\models\Product::findOne($product_id);
                    $session=Yii::$app->session['fxsc_cart'];//获取session值
                    $cart=\backend\modules\merchant\models\Cart::find()->where(['product_id'=>$_v['id'],'session_id'=>$session])->one();
                    $number=$cart['number'];
                    if ($number == null) {
                        $number = 0;
                    }
                ?>
                <dl>
                    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/good/commodity','aid'=>$_v['id']])?>">
                        <dt><img src="<?=$product['thumb']?>" alt="<?=$product['name']?>"></dt>
                        <dd>
                            <h3><?=$product['name']?></h3>
                            <span>已售：<?=$_v['sales']?><?=$product['sku']?></span><span>库存:<em class="stock"><?=$_v['bookable']?></em><?=$product['sku']?></span>
                            <h5>￥<em class="price"><?=$_v['price']?>/<?=$product['sku']?></em></h5>
                        </dd>
                        <div class="clear"></div>
                    </a>
                    <div class="plusminus">
                        <div class="gw_num">
                            <em class="min">-</em>
                            <input type="hidden" value="<?=$_v['id']?>" class="productid"/>
                            <input type="hidden" value="<?=$_v['bookable']?>" class="stock"/>
                            <input type="text" disabled="disabled" value="<?=$number?>" class="num"/>
                            <em class="add">+</em>
                        </div>
                    </div>
                </dl>
                <?php }?>

            </div>
        </div>

        <div id="woaicss_con2" style="display:none;">
            <div class="pecifics">
                <ol>
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/time.png">营业时间:<?=$supplier['open_hours']?$supplier['open_hours']:'每天8:00至22:00';?></li>
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/gsimg.png"><?=$supplier['address']?></li>
                    <li><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/dhimg.png"><a href="tel:<?=$supplier['phone']?>"><?=$supplier['phone']?></a> </li>
                    <li class="imgdiv"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/lbimg.png"><span><?=$supplier['notice']?$supplier['notice']:'如有疑问，请于商家联系！欢迎惠顾！'?></span>
                        <div class="clear"></div>
                    </li>
                </ol>
            </div>
        </div>

    </div>

    <!--悬浮菜单：开始-->
    <div class="bottomMenu">
        <dl>
            <dt><a href="#"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/wqw.png">共<span>￥</span><span id="total">￥0.00</span></a></dt>
            <dd class="order">立即下单</dd>
            <div class="clear"></div>
        </dl>
        <div id="sing">0</div>
    </div>
    <!--悬浮菜单：结束-->
</div>
<div class="person"><a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/index'])?>"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/count1.png"></a></div>
<div id="backToTop">
    <a href="javascript:;" onfocus="this.blur();" class="backToTop_a png"></a>
</div>
</body>
</html>
<script src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery.hDialog.js"></script>
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
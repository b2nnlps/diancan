<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 20:25
 */
use backend\modules\eshop\models\Cart;

$jssdk = new \common\wechat\JSSDK();
$signPackage = $jssdk->GetSignPackage();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= Yii::$app->params['eshop']?></title>
    <?= \yii\helpers\Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/eshop/font1/xiaogan.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/jquery.spinner.js"></script>
 <script>
        /**
         * 转发封面及简介
         * @returns {undefined}
         */
        var dataForShare={
            weixin_icon:"<?=$sumpplier['logo']?>",
            weixin_url:"http://ms.n39.cn/eshop/good/product-list?sump_id="+<?=$sumpplier['id']?>,
            weibo_icon:"<?=$sumpplier['logo']?>",
            url:"http://ms.n39.cn/eshop/good/product-list?sump_id="+<?=$sumpplier['id']?>,
            title:"<?=$sumpplier['name']?>",
            description:"<?=$sumpplier['open_scope']?>"
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
                    var data =csrfName + '='+crsfToken+"&number="+number.val()+"&productid="+productid.val();
                    $.post("<?=\yii\helpers\Url::to(['order/add-cart'])?>", data);
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
                var data =csrfName + '='+crsfToken+"&number="+number.val()+"&productId="+productid.val();
//                alert(data);
                $.post("<?=\yii\helpers\Url::to(['order/add-cart'])?>", data);
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
                    window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/cart','supplier_id'=>$supplier_id])?>";
                }
            });

        })
    </script>
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
            <p><?=$sumpplier['name']?></p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="Chika">
            <div class="Chikafusa"> <a href="#" onclick="woaicssq(1)" id="woaicsstitle" class="thisclass">商品</a> <a href="#" onclick="woaicssq(2)" id="woaicsstitle" class="">商户详情</a> </div>
        </div>

        <div id="woaicss_con1" style="display:block;">
            <div class="list">
                <?php
                foreach ($model as $_v){
                    $cart=Cart::find()->where(['product_id'=>$_v['id'],'session_id'=>Yii::$app->session->id])->one();
                    $number=$cart['number'];
                    if ($number==null){
                        $number=0;
                    } ?>
                        <dl>

                            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/good/commodity','id'=>$_v['id']])?>">
                                <dt> <img src="<?=$_v['thumb']?>" alt="<?=$_v['name']?>"></dt>
                                <dd>
                                    <h3><?=$_v['name']?></h3>
                                    <span>销售量：<?=$_v['sales'].$_v['sku']?></span><span>剩余:<em class="stock"><?=$_v['stock']?></em><?=$_v['sku']?></span>
                                    <h5>￥<em class="price"><?=floatval($_v['price'])?></em></h5>
                                </dd>
                                <div class="clear"></div>
                             </a>

                            <div class="plusminus">
                                <div class="gw_num">
                                    <em class="min">-</em>
                                    <input type="hidden" value="<?=$_v['id']?>" class="productid"/>
                                    <input type="hidden" value="<?=$_v['stock']?>" class="stock"/>
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
                        <li><ins class="icon-45"></ins>营业时间:<?=$sumpplier['open_hours']?></li>
                        <li><ins class="icon-1"></ins><?=$sumpplier['address']?></li>
                        <li><ins class="icon-7"></ins><?=$sumpplier['phone']?></li>
                        <li><ins class="icon-47"></ins><span><?=$sumpplier['notice']?></span>
                            <div class="clear"></div>
                        </li>
                    </ol>
                </div>
            </div>
        
    </div>
    <!--悬浮菜单：开始-->
    <!--<div class="bottomMenu">
     <dl>
       <dt><a href="#"><img src="images/qwe.png">购物车</a></dt>
       <dd>立即下单</dd>
       <div class="clear"></div>
     </dl>
    </div>-->
    <!--悬浮菜单：结束-->
    <!--悬浮菜单：开始-->
    <div class="bottomMenu">
        <dl>
            <dt><a href="#"><img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/wqw.png">共<span>￥</span><span id="total">￥0.00</span></a></dt>
            <dd class="order">立即下单</dd>
            <div class="clear"></div>
        </dl>
        <div id="sing">0</div>
    </div>
    <!--悬浮菜单：结束-->
</div>
<div class="personage">
    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/index'])?>">
        <ins class="icon-5"></ins><p>个人中心</p>
    </a>
</div>
<script type="text/javascript">
    $('.spinnerExample').spinner({});
</script>
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
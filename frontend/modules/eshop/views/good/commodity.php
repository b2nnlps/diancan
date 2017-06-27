<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-28
 * Time: 20:30
 */


/* @var $this \yii\web\View */
/* @var $content string */
use backend\modules\eshop\models\Cart;
use backend\modules\eshop\models\Orderproduct;
use backend\modules\sys\models\WechatUser;

$jssdk = new \common\wechat\JSSDK();
$signPackage = $jssdk->GetSignPackage();
$cart=Cart::find()->where(['product_id'=>$model['id'],'session_id'=>Yii::$app->session->id])->one();
$number=$cart['number'];
if ($number==null){
    $number=0;
}
$sumpplier=\backend\modules\eshop\models\Sumpplier::findOne($model['supplier_id']);
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
    <!--图片却换-->
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/jquery.touchSlider.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/pictures.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/message.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/eshop/js/jquery.spinner.js"></script>
	<script>
        /**
         * 转发封面及简介
         * @returns {undefined}
         */
        var dataForShare={
            weixin_icon:"<?=$model['thumb']?>",
            weixin_url:"http://ms.n39.cn/eshop/good/commodity?id="+<?=$model['id']?>,
            weibo_icon:"<?=$model['thumb']?>",
            url:"http://ms.n39.cn/eshop/good/commodity?id="+<?=$model['id']?>,
            title:"<?=$model['name']?>",
            description:"<?=$model['brief']?>"
        };
    </script>
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><ins class="icon-52"></ins></a></li>
            <p><?=$model['name']?></p>
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
                $img=explode(',',$model['image']);
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
            <h4><?=$model['name']?></h4>
            <h5>月售:<?=$model['sales'].$model['sku']?></h5>
            <dl>
                <dt>￥<em class="price"><?=floatval($model['price'])?></em></dt>
                <dd>
<!--                    <center>-->
<!--                        <input type="text" class="spinnerExample">-->
<!--                        <div class="clear"></div>-->
<!--                    </center>-->
                    <div class="gw_num">
                        <em class="min">-</em>
                        <input type="hidden" value="<?=$model['stock']?>" class="stock"/>
                        <input type="text" value="<?=$number?>" class="num"/>
                        <em class="add">+</em>
                    </div>
                </dd>
                <div class="clear"></div>
            </dl>
        </div>
        <div class="Business">
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['eshop/good/product-list', 'sump_id' => $sumpplier['id']]) ?>">
                <dl>
                    <dt>
                        <img src="<?=$sumpplier['logo']?>">
                    </dt>
                    <dd><h4><?=$sumpplier['name']?></h4>
                        <p><?=$sumpplier['notice']?></p>
                    </dd>
                    <div class="clear"></div>
                </dl>
            </a>
        </div>
        <div class="Chika">
            <div class="Chikafusa"> <a href="#" onclick="woaicssq(1)" id="woaicsstitle" class="thisclass">商品详情</a> <a href="#" onclick="woaicssq(2)" id="woaicsstitle" class="">销售记录</a> </div>
        </div>
        <div id="woaicss_con1" style="display:block;">
            <div class="describe">
               <?=$model['content']?>
            </div>
        </div>
        <div id="woaicss_con2" style="display:none;">
            <div class="record">
                <?php
                $product_id=$model['id'];
                $connection = Yii::$app->db;
                $sql = "select * from  {{%eshop_orderproduct}} where product_id=$product_id and status=10  order by id desc limit 0,8";
                $command=$connection->createCommand($sql);
                $orderproduct=$command->queryAll();
                foreach ($orderproduct as $_v){
                    ?>
                    <dl class="nm">
                        <dt><img src="<?=WechatUser::getHeadimgurl($_v['user_id'])?>"></dt>
                        <dd>
                            <h4><?=WechatUser::getNickname($_v['user_id'])?></h4>
                            <span> <?=$_v['created_time']?>&nbsp;&nbsp;订购：<?=$_v['number']?> <?=$_v['sku']?></span>
                        </dd>
                        <div class="clear"></div>
                    </dl>
                <?php } ?>
			</div>
			 <?php if(count($orderproduct)!=0){?>
                <div class="get_more">查看更多记录</div>
            <?php }else{?>
                <div class="null">没有相关记录</div>
            <?php } ?>
    </div>

    <!--悬浮菜单：开始-->
<!--    <div class="bottomMenu">-->
<!--     <dl>-->
<!--       <dt><a href="#"><img src="--><?//=Yii::$app->view->theme->baseUrl?><!--/eshop/images/qwe.png">购物车</a></dt>-->
<!--       <dd>立即下单</dd>-->
<!--       <div class="clear"></div>-->
<!--     </dl>-->
<!--    </div>-->

    <div class="bottomMenu">
        <dl>
            <dt>
                <a href="#">
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/eshop/images/wqw.png">共<span id="total">￥<?=$number*$model['price']?></span>
                </a>
            </dt>
<!--            <dd class="buy_btn"><a href="--><?//=Yii::$app->urlManager->createAbsoluteUrl(['eshop/index/cart'])?><!--">立即下单</a></dd>-->
            <dd class="buy_btn">立即下单</dd>
            <div class="clear"></div>
        </dl>
        <div id="sing"><?=$number?></div>
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
<script type="text/javascript">
    $(function () {
        $('.get_more').click(function () {
            if($(this).text()=='没有更多了'){return false;} //停止加载

            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');
            var list_num = $('.nm').length;  //获取当前总条数
            var amount = 8; //每次点击加载条数
            var product_id ='<?=$product_id?>';
            // alert(list_num);
//            $(this).text('').append("<img src='<?//=Yii::$app->view->theme->baseUrl?>///more/loader.gif'>");
            var data =csrfName + '='+crsfToken+"&list_num="+list_num+"&amount="+amount+"&product_id="+product_id;
			//  alert(data);
            $.post('<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/good/more'])?>',data, function (result){
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

</body>
</html>

<script src="<?=Yii::$app->request->baseUrl?>/hDialog/js/jquery.hDialog.js"></script>
<script>
    $(function(){
            $('.box').mousedown(function(){
                var t=$(this).parent().find('input[class*=num]');
                var number=t.val(parseInt(t.val()));
                var stock=parseInt($(this).parent().find('input[class*=stock]').val());
                if(number.val()>stock){
                    $.tooltip('预订商品超出剩余数量！');
                    t.val(stock);
                }
                setTotal();
            });

        $(".add").click(function(){
            var t=$(this).parent().find('input[class*=num]');
            var number=t.val(parseInt(t.val())+1);
            var stock=parseInt($(this).parent().find('input[class*=stock]').val());
            if(number.val()>stock){
                $.tooltip('预订商品超出剩余数量！');
                t.val(stock);
            }else{
                setTotal();
            }
        });
        $(".min").click(function(){
            var t=$(this).parent().find('input[class*=num]');
           t.val(parseInt(t.val())-1);
            if(parseInt(t.val())<0){
                t.val(0);
            }
            setTotal();
        });
        function setTotal(){
            var n=0;
            var s=0;
            $(".product dl").each(function(){
                n+=parseInt($(this).find('input[class*=num]').val());//parseInt() 函数可解析一个字符串，并返回一个整数。
                s+=parseInt($(this).find('input[class*=num]').val()) *parseFloat($(this).find('em[class*=price]').text());
            });
            $("#sing").html(n);//数量
            $("#total").html(s.toFixed(2));//总价，保留小数点后两位；toFixed() 方法可把 Number 四舍五入为指定小数位数的数字。
        }
        setTotal();
        
        $('.buy_btn').click(function() {
            var csrfName = $('meta[name=csrf-param]').prop('content');
            var crsfToken = $('meta[name=csrf-token]').prop('content');
            var number=$('.num');
            if(number.val() ==='0'){
                $.tooltip('您还没选择商品数量呢...'); number.focus();
            }else{
                $.dialog('confirm','提示','您确定要下单吗？',0,function(){
                    var data =csrfName + '='+crsfToken+"&number="+number.val()+"&productid="+<?=$model->id?>;
                    //                    alert(data);
                    $.post("<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/add-cart'])?>", data, function (result) {
                        if(result!==''){
                            $.dialog( 'alert','温馨提示', result, 4000,true);
                        } else{
                            window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/cart','supplier_id'=>$model->supplier_id])?>";
                        }
                    });
                 });
            }
        });

    });

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
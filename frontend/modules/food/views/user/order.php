<?php
use yii\helpers\Html;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>下单信息</title>
    <link href="/static/food/css/style.css" rel="stylesheet" type="text/css">
    <script src="/static/food/js/jquery-1.11.2.js"></script>
    <?= Html::csrfMetaTags() ?>
</head>

<body style=" background-color:#EFEFF0;">
<div class="box"><!--头部：开始--->
    <div class="pricebox">
        <div class="price">
            <p><span>订单</span></p>
            <ol class="clearfix">
                <?=$text?>
            </ol>

            <h2><span>合计金额：</span>￥<?=$total_price?></h2>
        </div>
    </div>

    <div class="data">
        <div class="headline">
            <h4><span>店内消费</span></h4>
        </div>
        <form action="/food/user/pay-order" method="post" id="form">
        <ul>
            <li class="clearfix">
                <label>您的姓名</label>
                <input type="text" name="name" required="required" placeholder="请输入您的姓名(必填)" value="<?=$u['realname']?>">
            </li>
            <li class="clearfix">
                <label>手机号码</label>
                <input type="text" name="phone" required="required" placeholder="请输入您的号码（必填）" value="<?=$u['phone']?>">
                <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" name="_csrf" >
            </li>
            <li class="clearfix">
                <label>订单备注</label>
                <input type="text" name="notic" placeholder="备注" value="<?=$u['notic']?>">
                <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" name="_csrf" >
            </li>
            <li class="clearfix">
                <label>输入台号</label>
                <?php
                    if(isset($_COOKIE['table'])){
                        echo "<span>$_COOKIE[table]</span>";
                    }else{
                        echo '<input type="text" required="required"  name="table" placeholder="请输入您的桌号" />';
                    }
                ?>
                </li>
        </ul>
        </form>
    </div>

    <div class="paymentbox">
        <h4><span>付款方式</span></h4>
        <div class="payment">
            <p class="clearfix"><span></span><em><img src="/static/food/images/weixin.png"> 微信支付</em></p>
        </div>
    </div>

    <div class="submit">
        <dl class="clearfix">
            <dt><a href="javascript:history.go(-1)">修改/加菜</a></dt>
            <dd><a href="#" onclick="post()">提交订单</a></dd>
        </dl>
    </div>
</div>
</body>
</html>
<script>
function post(){
    var name=$("input[name='name']");
    var phone=$("input[name='phone']");
    if(name.val()=="") {name.focus(); alert("您的称呼"); return 0;}
    if(phone.val()=="" || phone.val().length<8) {phone.focus(); alert("您的手机号码错误"); return 0;}

    $("form").submit();
}
</script>
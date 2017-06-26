<?php
use member\modules\food\models\OrderInfo;
use member\modules\food\models\Food;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>点菜系统</title>
    <link href="/static/food/css/style.css" rel="stylesheet" type="text/css">
    <script src="/static/food/js/jquery-1.8.3.min.js"></script>
    <script src="/static/food/js/index.js"></script>
</head>

<body style="background-color:#EFEFF0;">
<div class="box" style="background-color:#FFF;"><!--头部：开始--->

    <div class="navigation">
        <ul class="clearfix">
            <li style="<?=$status==0?'border:1px solid #F5234A; background-color:#F5234A;':''?>"><a style="<?=$status==0?'color:#fff;':''?>" href="/food/user/my-order?status=0">进行中</a></li>
            <li style="<?=$status==1?'border:1px solid #F5234A;background-color:#F5234A; color:#fff;':''?>"><a style="<?=$status==1?'color:#fff;':''?>" href="/food/user/my-order?status=1">已完成</a></li>
        </ul>
        <dl class="clearfix">
            <dt><a href="/food/user/index<?='?shop='.@$_COOKIE['shop']?>"><span>店内消费</span></a><img src="/static/food/images/right.png"></dt>
            <dd></dd>
        </dl>
    </div>

    <?php
    foreach($o as $_o){
        $info=OrderInfo::findAll(['order_id'=>$_o['id']]);
        $total=0;$text='';$i=0;
        foreach($info as $_info) {$i++; $total+=$_info['num']*$_info['price'];$food=Food::findOne($_info['food_id']);$text.="<li class='clearfix'><span>$i.$food[name]</span><cite>￥$_info[price]</cite><em>x$_info[num]</em></li>";}
        echo "
  <div class='details' id='d$_o[id]'>
            <dl class='clearfix'>
            <dt>
            <h4><span>订单：</span>$_o[id]</h4>
            <time>$_o[created_time]</time>
            <h4><span>$_o[text]</span></h4>
            </dt>
            <dd>
                <h4>￥$total</h4>
                <Span>在线支付</Span>
            </dd>
        </dl>
        </div>
         <div class='container'>
            <div class='accordion'> <a><img src='/static/food/images/down.png'></a></div>
        <div class='accordion-desc'>
                <h3>订单详情</h3>
                <ul>
                    $text
                </ul>
                <ol>
                    <li><span>订单号码：</span>$_o[id]</li>
                    <li><span>订单信息：</span>$_o[text]</li>
                    <li><span>总消费：</span>￥$total</li>
                    <li><span>下单时间：</span>$_o[created_time]</li>

                </ol>
            </div>
        </div>

         <div class='operating_food clearfix'>
         ";
        if(!$status) echo "
        <a style=' border-right:1px solid #000;' href='http://ms.n39.cn/wxpayapi/n_food_pay.php?order_id=$_o[id]'>支付订单</a>
                <a href='#'>追加菜品</a>
    ";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>

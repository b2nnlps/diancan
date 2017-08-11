<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合点餐</title>
    <link href="/static/food/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="confirmation">
        <img src="/static/food/images/confirmation.png">

        <h3>下单成功</h3>
        <h4><?php
            if ($o['status'] == 1 || $o['status'] == 3)
                echo '厨房正在出单...';
            if ($o['status'] == 0)
                echo '等待支付中...';

            ?></h4>
    </div>
    <div class="examine">
        <?php
        if ($o['status'] == 0)
            echo ' <a href="/wxpay/' . $o['shop_id'] . '/n_food_pay.php?order_id=' . $o['id'] . '">前往支付</a>';
        if ($o['status'] == 1) {
            setcookie('cart', '', time() - 1, '/');
            echo '<a href="/food/user/my-order">查看我的订单</a>';
        }
        if ($o['status'] == 3) {
            echo '<a href="/food/user/index">返回首页</a>';
            setcookie('cart', '', time() - 1, '/');
        }


        ?>
    </div>
    <div class="footer"><p>©琼海玲珑软件有限公司 版权所有</p>

        <p>联系电话：<a href="tel:089862922223">089862922223</a></p></div>
</div>
</body>
</html>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合点餐系统</title>
    <link href="/static/627dc/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="/food/user/my-order"><img src="/static/627dc/images/fh.png" width="20" height="20"></a></li>
            <p>订单详情</p>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
       <div class="details_box">
          <h4>我的菜单</h4>
           <?php
           $total_number=0;$total_price=0;
           foreach ($orderInfo as $_o){
               $total=$_o['num']*$_o['price']/100;
               $total_number+=$_o['num'];
               $total_price+=$total;
               $name = (strlen($_o['title']) > 0) ? $_o['name'] . '-' . $_o['title'] : $_o['name'];

               echo <<<EOD
 <dl class="clearfix">
                  <dt>
                  <h5>$name</h5>
                  <span>$_o[text]</span>
                  </dt>
                  <dd><span class="amount_box">X$_o[num]</span><span class="price_box">￥$total</span></dd>
              </dl>
EOD;

           }
           ?>
           <dl class="clearfix" id="allot">
                  <dt>数量：<em style="color:#F32442;"><?=$total_number?></em></dt>
                  <dd style=" text-align:right;">合计：<em style="color:#F32442; font-size:18px;">￥<?=$total_price?></em></dd>
              </dl>
           <div class="blank_box"></div>
           <ul>
               <li>订单ID：<?=$o['id']?></li>
               <li>下单人：<?=$o['realname']?></li>
               <li>联系电话：<?=$o['phone']?></li>
               <li>就餐桌号：<?=$o['table']?></li>
               <li>订单状态：<?php
                   if ($o['status'] == 0) echo '未支付';
                   if ($o['status'] == 1) echo '已支付';
                   if ($o['status'] == 2) echo '已完成';
                   if ($o['status'] == 3) echo '现金支付'; ?></li>
               <li>下单时间：<?=$o['created_time']?></li>
               <li>备注：<?=$o['text']?></li>
              </ul>
           </div>
           <div class="delivery">
               <?php
               if($o['status']){
                   echo '<div class="submit_box1"><button id="conf" style="background-color: #00bf00">已完成</button></div>';
               }else{
                   echo '<a href="/wxpay/' . $o['shop_id'] . '/n_food_pay.php?order_id=' . $o['id'] . '"><div class="submit_box1"><button id="conf">去支付</button></div>';
               }
               ?>
         </div>
    </div>
</div>
<div id="big" style="display: block; width: 10px;"></div>
</body>
</html>
<script src="/static/food/js/jquery-1.11.2.js"></script>
<script>
    $("#big").css('height', $(window).height() - $(".box").height() + 1);
</script>
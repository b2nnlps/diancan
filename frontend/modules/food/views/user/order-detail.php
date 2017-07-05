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
            <li><a href="javascript:history.go(-1)"><img src="/static/627dc/images/fh.png" width="20" height="20"></a></li>
            <p>订单详情</p>
            <li><a href="checkout_success.html">去支付</a></li>
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

               echo <<<EOD
 <dl class="clearfix">
                  <dt>
                  <h5>$_o[name]</h5>
                  <span>$_o[text]</span>
                  </dt>
                  <dd><span class="amount_box">X$_o[num]</span><span class="price_box">￥$total</span></dd>
              </dl>
EOD;

           }
           ?>



              <dl class="clearfix">
                  <dt>数量：<em style="color:#F32442;"><?=$total_number?></em></dt>
                  <dd style=" text-align:right;">合计：<em style="color:#F32442; font-size:18px;">￥<?=$total_price?></em></dd>
              </dl>
           <div class="blank_box"></div>
           <ul>
               <li>订单ID：<?=$o['id']?></li>
               <li>下单人：<?=$o['realname']?></li>
               <li>联系电话：<?=$o['phone']?></li>
               <li>就餐桌号：<?=$o['table']?></li>
               <li>订单状态：<?=$o['status']?'已完成':'未支付'?></li>
               <li>下单时间：<?=$o['created_time']?></li>
               <li>备注：<?=$o['text']?></li>
              </ul>
           </div>
           <div class="delivery">
               <?php
               if($o['status']){
                   echo '<div class="submit_box1"><button id="conf" style="background-color: #00bf00">已完成</button></div>';
               }else{
                   echo '<a href="/wxpayapi/n_food_pay.php?order_id='.$o['id'].'"><div class="submit_box1"><button id="conf">去支付</button></div>';
               }
               ?>
         </div>
    </div>
</div>

</body>
</html>
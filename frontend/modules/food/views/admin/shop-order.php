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
    <style>
        .del{
            text-decoration:line-through;
        }
        .f{
            color: #F5234A;
        }
        </style>
</head>

<body style="background-color:#EFEFF0;">
<div class="box" style="background-color:#FFF;"><!--头部：开始--->

    <div class="navigation">
        <ul class="clearfix">
            <li style="<?=$status==1?'border:1px solid #F5234A; background-color:#F5234A;':''?>"><a style="<?=$status==1?'color:#fff;':''?>" href="/food/admin/shop-order?status=1">进行中</a></li>
            <li style="<?=$status==2?'border:1px solid #F5234A;background-color:#F5234A; color:#fff;':''?>"><a style="<?=$status==2?'color:#fff;':''?>" href="/food/admin/shop-order?status=2">已完成</a></li>
        </ul>
        <dl class="clearfix">
            <dt></dt>
            <dd></dd>
        </dl>
    </div>

    <?php
    foreach($o as $_o){
        $info=OrderInfo::findAll(['order_id'=>$_o['id']]);
        $total=0;$text='';$i=0;
        foreach($info as $_info) {
            $i++;
            $total += $_info['num'] * $_info['price'] / 100;
            $food=Food::findOne($_info['food_id']);
            $class=$_info['status']?' class="del"':'class="f"  onclick="HideDiv('.$_o[id].','.$_info[id].')"'; if($status==2){$class='';}
            $text .= "<li class='clearfix'><span><a id='f$_info[id]' $class>$i.$food[name]</a></span><cite>￥" . $_info['price'] / 100 . "</cite><em>x$_info[num]</em></li>";
        }

        echo "<div  id='d$_o[id]' class='neil' v='$_o[id]' num='$i'>
  <div class='details'>
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
        <div class='accordion-desc'>
                <h3>订单详情</h3>
                <ul>
                    $text
                </ul>

            </div>
        </div>

         <div class='operating_food clearfix'>
         ";
        if($status==1) echo "
        <a style=' border-right:1px solid #000;' onclick='' ></a>
                <a href='#'></a>
    ";
        echo "</div></div>";
    }
    ?>
</div>
</body>
</html>
<script>
    if(<?=$status?>==1) setInterval("GetOrder()",5000);

    function HideDiv(o_id,f_id){
        if(confirm("确认上菜")){
        $.get("/food/admin/shop-order-success?o_id="+o_id+"&f_id="+f_id, {},
            function(data){
                    $("#f"+f_id).attr("class","del");
                    $("#f"+f_id).attr("onclick","");
            });
        }

        $(".neil").each(function(){
            var del=0;
            $("#d"+o_id+" .del").each(function(){
                del++;
            });

            if(del==$(this).attr("num")){
                $(this).slideUp();
            }
        });
    }
    function GetOrder(){
        var has="";
        $(".neil").each(function(){
            if($(this).css("display")!='none'){
                has+=$(this).attr("v")+',';
            }
        });
        $.get("/food/admin/shop-order-js?v="+has, {},
            function(data){
                $(".box").append(data);
            });
    }

    </script>

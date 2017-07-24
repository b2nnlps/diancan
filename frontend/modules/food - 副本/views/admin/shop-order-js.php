<?php
use member\modules\food\models\OrderInfo;
use member\modules\food\models\Food;
?>
    <?php
if(is_array($o))
    foreach($o as $_o){
        $info=OrderInfo::findAll(['order_id'=>$_o['id']]);
        $total=0;$text='';$i=0;
        foreach($info as $_info) {
            $i++;
            $total+=$_info['num']*$_info['price'];
            $food=Food::findOne($_info['food_id']);
            $class=$_info['status']?' class="del"':'class="f"  onclick="HideDiv('.$_o[id].','.$_info[id].')"'; if($status==2){$class='';}
            $text.="<li class='clearfix'><span><a id='f$_info[id]' $class>$i.$food[name]</a></span><cite>￥$_info[price]</cite><em>x$_info[num]</em></li>";
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
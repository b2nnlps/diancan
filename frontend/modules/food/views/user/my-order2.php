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
            <p>订单列表</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
<!--        <div class="seek_box">-->
<!--              <div class="seek clearfix">-->
<!--               <input type="text" placeholder="请输入您查询订单ID">-->
<!--               <a href="#"><img src="/static/627dc/icon/ssimg.png"></a>-->
<!--              </div>-->
<!--         </div>-->
        <div class="Chika">
            <div class="Chikafusa">
                <a href="#" onClick="woaicssq(1)" id="woaicsstitle" class="thisclass">待付款</a>
                <a href="#" onClick="woaicssq(2)" id="woaicsstitle" >进行中</a>
                <a href="#" onClick="woaicssq(3)" id="woaicsstitle" >已完成</a>
            </div>
        </div>
        <div class="blank_box"></div>
        <div id="woaicss_con1" style="display:block;">

            <div class="indent">
                <?php
                $i=0;
                    foreach ($o as $_o){
                        if($_o['status']==0){
                            $i++;
                            echo <<<EOD
    <a href="/food/user/order-detail?order_id=$_o[id]">
                    <ul>
                        <li class="clearfix"><h4>订单ID：$_o[id]</h4><span class="unpaid_box">待支付</span></li>
                        <li class="clearfix" style="border:none; margin-bottom:-10px;"><h4>桌号：$_o[table]</h4><span class="consume_box">￥$_o[total]</span></li>
                        <li class="clearfix"><h4 class="time_box">下单时间：$_o[created_time]</h4><span style="color:#A0A3A5; font-size:14px;"></span></li>
                        <div class="hint_box"><img src="/static/627dc/images/tishi.png" width="15" height="15">$_o[text]</div>
                    </ul>
                </a>
                <div class="blank_box"></div>
EOD;
                        }
                    }
                    if(!$i)
                        echo '<div class="zw_box">
                  <img src="/static/627dc/images/zwjlimg.png">
                  <p>暂无记录！</p>
                </div>';

                ?>

            </div>
            <div class="load_more"><a href="#">加载更多</a></div>
        </div>
        <!---->
        <div id="woaicss_con2" style="display:none;">
            <div class="indent">

                <?php
                $i=0;
                foreach ($o as $_o){
                    if($_o['status']==1){
                        $i++;
                        echo <<<EOD
    <a href="/food/user/order-detail?order_id=$_o[id]">
                    <ul>
                        <li class="clearfix"><h4>订单ID：$_o[id]</h4><span class="unpaid_box">待支付</span></li>
                        <li class="clearfix" style="border:none; margin-bottom:-10px;"><h4>桌号：$_o[table]</h4><span class="consume_box">￥$_o[total]</span></li>
                        <li class="clearfix"><h4 class="time_box">下单时间：$_o[created_time]</h4><span style="color:#A0A3A5; font-size:14px;"></span></li>
                        <div class="hint_box"><img src="/static/627dc/images/tishi.png" width="15" height="15">$_o[text]</div>
                    </ul>
                </a>
                <div class="blank_box"></div>
EOD;
                    }
                }
                if(!$i)
                    echo '<div class="zw_box">
                  <img src="/static/627dc/images/zwjlimg.png">
                  <p>暂无记录！</p>
                </div>';

                ?>
					
                  
				  
            </div>
             <div class="load_more"><a href="#">加载更多</a></div>
              <!--<div class="zw_box">
                  <img src="images/zwjlimg.png">
                  <p>暂无记录！</p>
                </div>-->
        </div>
        <!---->
        <div id="woaicss_con3" style="display:none;">
            <div class="indent">

                <?php
                $i=0;
                foreach ($o as $_o){
                    if($_o['status']==2){
                        $i++;
                        echo <<<EOD
    <a href="/food/user/order-detail?order_id=$_o[id]">
                    <ul>
                        <li class="clearfix"><h4>订单ID：$_o[id]</h4><span class="unpaid_box">待支付</span></li>
                        <li class="clearfix" style="border:none; margin-bottom:-10px;"><h4>桌号：$_o[table]</h4><span class="consume_box">￥$_o[total]</span></li>
                        <li class="clearfix"><h4 class="time_box">下单时间：$_o[created_time]</h4><span style="color:#A0A3A5; font-size:14px;"></span></li>
                        <div class="hint_box"><img src="/static/627dc/images/tishi.png" width="15" height="15">$_o[text]</div>
                    </ul>
                </a>
                <div class="blank_box"></div>
EOD;
                    }
                }
                if(!$i)
                    echo '<div class="zw_box">
                  <img src="/static/627dc/images/zwjlimg.png">
                  <p>暂无记录！</p>
                </div>';

                ?>
            
            </div>
             <div class="load_more"><a href="#">加载更多</a></div>
              <!--<div class="zw_box">
                  <img src="images/zwjlimg.png">
                  <p>暂无记录！</p>
                </div>-->
        </div>

    </div>
</div>

</body>
</html>
<script src="/static/627dc/js/jquery-1.8.3.min.js"></script>
<script language="javascript">
    function woaicssq(num){
        for(var id = 1;id<=3;id++)
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

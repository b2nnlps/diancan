<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合点餐系统</title>
    <link href="/static/627dc/css/style.css" rel="stylesheet" type="text/css">
    <link href="/static/627dc/css/demo.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="/static/627dc/images/fh.png" width="20" height="20"></a></li>
            <p>确认订单</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="order_box">
            <div style=" background-color:#EDF1F1; height:10px;"></div>
            <h4><span>订单明细</span></h4>
          <?=$text?>
            <dl class="clearfix">
                <dt>数量：<em style="color:#F32442;"><?=$total_number?></em></dt>
                <dd style=" text-align:right;">合计：<em style="color:#F32442; font-size:18px;">￥<?=$total_price?></em></dd>
            </dl>
        </div>
        <div class="consumption_box">
            <div style=" background-color:#EDF1F1; height:10px;"></div>
            <h4><span>消费信息</span></h4>
            <ul>
                <li><span>顾客姓名：</span><input placeholder="输入姓名【必填】" type="text" value="<?=$u['realname']?>" required></li>
                <li><span>手机号码：</span><input placeholder="输入手机号码【必填】" type="text" maxlength="11" value="<?=$u['phone']?>" required></li>
                <li class="clearfix">
                    <span class="span_box">就餐人数：</span>
                    <em>
                        <div class="gw_num">
                            <em class="jian">-</em>
                            <input type="text" value="1" class="num"/>
                            <em class="add">+</em>
                        </div>
                        <!--<a href="#">-</a><input value="1" type="text" /><a href="#">+</a>-->
                    </em>
                </li>
                <li><span>就餐桌号：</span><input placeholder="输入桌号" type="text" value="<?=isset($_COOKIE['table'])?$_COOKIE['table']:''?>" required></li>
                <li><span>需求备注：</span><input placeholder="输入其他需求" type="text" value="<?=$u['notic']?>"></li>
                <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" name="_csrf" >
            </ul>
        </div>
        <div class="Payment_box">
            <div style=" background-color:#EDF1F1; height:10px;"></div>
            <h4><span>付款方式</span></h4>
            <ul>
                <li class="clearfix">
                    <div class="icon_box">
                        <label for="c1"><img src="/static/627dc/images/wx.png">微信支付</label></div>
                    <div class="pay_box">
                        <input class="magic-checkbox" type="radio" name="layout" id="c1" checked="checked">
                        <label for="c1"></label>
                    </div>
                </li>
<!--                <li  class="clearfix">-->
<!--                    <div class="icon_box">-->
<!--                        <label for="c2"><img src="/static/627dc/images/zfb.png">支付宝支付</label></div>-->
<!--                    <div class="pay_box">-->
<!--                        <input class="magic-checkbox" type="radio" name="layout" id="c2">-->
<!--                        <label for="c2"></label>-->
<!--                    </div>-->
<!--                </li>-->
            </ul>
        </div>
    </div>
    <div class="submit">
        <dl class="clearfix">
            <dt><a href="shopping_cart.html">返回购物车</a></dt>
            <dd><a href="checkout_success.html">提交订单</a></dd>
        </dl>
    </div>
</div>




</body>
</html>
<script type="text/javascript" src="/static/627dc/js/jquery-1.8.3.min.js"></script>
<script>

    $(document).ready(function(){
        //加的效果
        $(".add").click(function(){
            var n=$(this).prev().val();
            var num=parseInt(n)+1;
            if(num==0){ return;}
            $(this).prev().val(num);
        });
        //减的效果
        $(".jian").click(function(){
            var n=$(this).next().val();
            var num=parseInt(n)-1;
            if(num==0){ return}
            $(this).next().val(num);
        });
    })
</script>

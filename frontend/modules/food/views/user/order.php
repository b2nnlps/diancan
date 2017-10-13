<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>订单确认</title>
    <link href="/static/627dc/css/style.css" rel="stylesheet" type="text/css">
    <link href="/static/627dc/css/demo.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="/static/627dc/images/fh.png" width="20" height="20"></a>
            </li>
            <p>确认订单</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="order_box">
            <div style=" background-color:#EDF1F1; height:10px;"></div>
            <h4><span>订单明细</span></h4>
            <?= $text ?>
            <dl class="clearfix" id="allot">
                <dt>数量：<em style="color:#F32442;"><?= $total_number ?></em></dt>
                <dd style=" text-align:right;">合计：<em style="color:#F32442; font-size:18px;">￥<?= $total_price ?></em>
                </dd>
            </dl>
        </div>
        <form action="/food/user/pay-order" method="post" id="form">
            <div class="consumption_box">
                <div style=" background-color:#EDF1F1; height:10px;"></div>
                <h4><span>消费信息</span></h4>
                <ul>
                    <li><span>顾客姓名：</span><input placeholder="输入姓名【必填】" id="name" name="name" type="text"
                                                 required="required" value="<?= $u['realname'] ?>"></li>
                    <li><span>手机号码：</span><input placeholder="输入手机号码【必填】" id="phone" name="phone" type="text"
                                                 maxlength="11" required="required" value="<?= $u['phone'] ?>"></li>
                    <li class="clearfix">
                        <span class="span_box">就餐人数：</span>
                        <em>
                            <div class="gw_num">
                                <em class="jian">-</em>
                                <input type="text" value="1" class="num" name="people"/>
                                <em class="add">+</em>
                            </div>
                            <!--<a href="#">-</a><input value="1" type="text" /><a href="#">+</a>-->
                        </em>
                    </li>
                    <li><span>就餐桌号：</span><input placeholder="输入桌号" id="table" name="table" type="text"
                                                 required="required"
                            <?= isset($_COOKIE['table']) ? 'readonly="readonly"' : '' ?>
                                                 value="<?= isset($_COOKIE['table']) ? $_COOKIE['table'] : '' ?>"></li>
                    <li><span>需求备注：</span><input placeholder="输入其他需求" id="notic" name="notic" type="text"
                            ></li>
                    <input type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>" name="_csrf">
                </ul>
            </div>
        </form>
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
            <a href="/food/user/index">
                <dt style="color:#fff">继续添加</dt>
            </a>
            <a href="#" onclick="post()">
                <dd style="color:#fff">提交订单</dd>
            </a>
        </dl>
    </div>
</div>


</body>
</html>
<script type="text/javascript" src="/static/627dc/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/static/84dc/js/layer/layer.js"></script>
<script>

    $(document).ready(function () {
        //加的效果
        $(".add").click(function () {
            var n = $(this).prev().val();
            var num = parseInt(n) + 1;
            if (num == 0) {
                return;
            }
            $(this).prev().val(num);
        });
        //减的效果
        $(".jian").click(function () {
            var n = $(this).next().val();
            var num = parseInt(n) - 1;
            if (num == 0) {
                return
            }
            $(this).next().val(num);
        });
    })
</script>
<script>
    var pass = true;
    <?php
            if(!$staff)
                if(!is_dir("wxpay/".$_COOKIE['shopId'])) echo 'pass = false;'; //商家未开通微信支付
     ?>
    if (!pass)
        undo();
    function post() {
        if (!pass) {
            undo();
            return;
        }

        var name = $("#name");
        var phone = $("#phone");
        var table = $("#table");
        if (name.val() == "") {
            name.focus();
            alert("您的称呼");
            return 0;
        }
        if (phone.val() == "" || phone.val().length < 8) {
            phone.focus();
            alert("您的手机号码错误");
            return 0;
        }
        if (table.val() == "") {
            table.focus();
            alert("请输入桌号");
            return 0;
        }

        $("form").submit();
    }
    function undo() {
        layer.msg("十分抱歉，该商家并未开通微信支付，请呼叫服务员为您下单。");
    }
</script>
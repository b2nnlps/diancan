<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <link href="/static/627dc/css/user.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="/static/627dc/icon/return1.png" width="30" height="30"></a></li>
            <p>个人中心</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <header>
            <dl>
                <dt> <img src="<?=$u['headimgurl']?>"></dt>
                <dd>
                    <h4><?=$u['nickname']?></h4>
                    <p>人生的机遇，在于无形的发现！</p>
                </dd>
                <div class="clear"></div>
            </dl>
        </header>
        <!--个人中心：开始-->
        <div class="personalCenter">
            <!--个人信息-->
            <div class="recharge_box">
                <div class="recharge clearfix">
                    <a class="kf" href="#"><span><img src="/static/627dc/icon/djq.png">代金券</span></a>
                    |
                    <a class="" href="#"><span><img src="/static/627dc/icon/jfsc.png">积分商城</span></a>
                </div>
            </div>
            <!--功能列表-->
            <ul>
                <!--                 <a href="/food/user/">-->
                <!--                    <li><img src="/static/627dc/icon/sy.png"><em>店铺首页</em></li>-->
                <!--                </a>-->
             <a href="/food/user/my-order">
                    <li><img src="/static/627dc/icon/dd.png"><em>我的订单</em></li>
                </a>
                <div id="fgdiv"></div>
                <?php
                if($staff) {
                    ?>
                    <a href="/food/admin/shop-setting">
                        <li><img src="/static/627dc/icon/wd.png"><em>微管理</em>
                        </li>
                    </a>
                    <a href="/food/admin/shop-order">
                        <li><img src="/static/627dc/icon/wdd.png"><em>微店订单</em></li>
                    </a>
                    <a href="/food/admin/food-list">
                        <li><img src="/static/627dc/icon/cpimg.png"><em>商品管理</em></li>
                    </a>
                    <?php
                }
                ?>
				<a href="/food/admin/bind">
                    <li><img src="/static/627dc/icon/bd.png"><em>店员绑定</em></li>
                </a>
				<a href="/food/user/j-record">
                    <li><img src="/static/627dc/icon/dh.png"><em>兑换订单</em></li>
                </a>
           
                <div id="fgdiv"></div>
              

            </ul>
        </div>
        <?= $this->render('footer') ?>
        <!--个人中心：结束-->
    </div>
</div>
<div id="big" style="display: block; width: 10px;"></div>
</body>
</html>
<script src="/static/food/js/jquery-1.11.2.js"></script>
<script>

    $("#big").css('height', $(window).height() - $(".box").height() + 1);
    $(function(){
        //正确文字提示
        $('.kf').click(function(){
            layer.msg('正在开发中，敬请期待。。。');
        });
    });
</script>
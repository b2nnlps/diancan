<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>容合点餐系统</title>
    <link href="/static/84dc/css/list_v1.css" rel="stylesheet">
</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="list_top"><a href="store.html">
            <dl class="clearfix">
                <dt><img id="shop_img" src=""></dt>
                <dd>
                    <h4 id="shop_name"></h4>

                    <p id="shop_description"></p>
                </dd>
            </dl>
        </a>
    </div>
    <div class="main">
        <div class="list_relative" id="title1">
            <!--左边栏分类-->
            <div class="list_menu">

            </div>
            <!--left menu end-->
            <div style="height:100px"></div>
            <div class="list_box">
                <!--右边栏菜品-->


                <!--right end-->
            </div>
        </div>
    </div>
    <div class="closing">
        <dl class="clearfix">
            <dt id="cartShow">
            <div class="dt_box"><a><img src="/static/84dc/images/gwc.png"/>

                    <div class="data_box"><span id="totalcountshow">0</span></div>
                </a></div>
            <!--<div class="sum_box"><span>￥<i id="totalpriceshow">0</i></span> <em>另需配送费￥5</em> </div>-->
            <div class="sum_boxv1"><span>合计￥<i id="totalpriceshow">0</i></span></div>
            </dt>
            <a href="Payment_order.html">
                <dd>结算</dd>
            </a>
        </dl>
    </div>
    <!--遮罩盒子-->
    <div id="fade"></div>
    <div class="fade"></div>

    <div class="show_box">
        <div class="close_box"><img src="/static/84dc/images/close3.png"/></div>
        <div class="greens_box">
            <dl class="clearfix">
                <dt><img id="cart_img"/></dt>
                <dd>
                    <h3 id="cart_name"></h3>
                    <span id="cart_price" data-price=""></span>
                </dd>
            </dl>
        </div>
        <div class="btn_box">
            <h4>规格</h4>
            <ul>
                <div id="cart_info" class="select_btn clearfix">
                </div>
            </ul>
        </div>
        <div class="modified_box clearfix">
            <dl>
                <dt>购买数量：</dt>
                <dd>
                    <div class="gw_num">
                        <em class="gw_minus">-</em>
                        <input id="cart_num" type="text" value="1" class="num"/>
                        <em class="gw_add">+</em>
                    </div>
                </dd>
            </dl>
        </div>
        <div class="text_box">
            <textarea id="cart_text" placeholder="请您输入您的需求"></textarea>
        </div>
        <div class="affirm_boxv1"><a href="#">加入购物车</a></div>
    </div>

    <div class="pop_box">
        <div class="cart_top">
            <dl class="clearfix">
                <dt>购物车</dt>
                <dd><a href="#"><img src="/static/84dc/icon/scicon.png" width="15" height="15"/>清除</a></dd>
            </dl>
        </div>
        <div class="cart_box">
            <dl class="clearfix">
                <dt>香辣排骨</dt>
                <dd>￥108</dd>
                <div class="btn_v2">
                    <button class="cart_minus">
                        <strong></strong>
                    </button>
                    <i>1</i>
                    <button class="cart_add">
                        <strong></strong>
                    </button>
                </div>
            </dl>

        </div>
    </div>
</div>

</body>
<script type="text/javascript" src="/static/84dc/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/static/84dc/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/static/84dc/js/jquery.lazyload.js?v=1.9.1"></script>
<script type="text/javascript" src="/static/84dc/js/layer/layer.js"></script>
<script type="text/javascript" src="/static/84dc/js/index_css.js"></script>
<script type="text/javascript" src="/static/84dc/js/index.js"></script>
<script type="text/javascript" src="/static/84dc/js/index_api.js"></script>
<script>
    var index;
    var shopId = <?=$shopId?>;
    layer.ready(function () {
        index = layer.load(0, {shade: false});
        getFoodList(shopId);
    });
</script>
</html>
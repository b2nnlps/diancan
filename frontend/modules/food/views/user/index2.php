<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title>点餐系统</title>
    <link href="/static/627dc/css/list.css" rel="stylesheet">
    <script src="/static/food/js/jquery-1.11.2.js"></script>
    <script src="/js/layer/layer.js"></script>
    <script type="text/javascript"
            src="/static/food/js/jquery.cookie.js"></script>
    <script type="text/javascript"
            src="/static/food/js/jquery.lazyload.js?v=1.9.1"></script>

</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="list_top">

        <dl class="clearfix">
            <dt><img src="<?=$shop['img']?$shop['img']:'/static/627dc/icon/rh_logo.png'?>"></dt>
            <dd>
                <h4><?=$shop['name']?></h4>
                <p><?=$shop['description']?></p>
            </dd>
        </dl>
    </div>
    <div class="main">
        <div class="list_relative" id="title1">
            <!--left menu-->
            <div class="list_menu">
                <?php
                $t = "";
                $i = 0;
                foreach ($food as $_food) {
                    if ($_food['cname'] != $t) {
                        $i++;
                        $str = $i == 1 ? 'li on' : 'li';
                        echo '<a href="#title' . $i
                            . '"><div class="' . $str . '">' . $_food['cname'] . '</div></a>';
                        $t = $_food['cname'];
                    }
                }
                ?>

                <div style=" padding-bottom:200px;"></div>
            </div>
            <!--left menu end-->
            <div style="height:100px"></div>
            <div class="list_box">
                <!--right-->
                <?php
                $i           = 0;
                $t           = "";
                $end         = false;
                $old         = 0;
                $guige_id    = [];
                $guige_name  = [];
                $guige_price = [];
                foreach($food as $_food){
                    if(!isset($guige_id[$_food['id']])){
                        $guige_id[$_food['id']]=$_food['iid'];
                        $guige_name[$_food['id']]=$_food['title'];
                        $guige_price[$_food['id']]=$_food['price'];
                    }else{
                        $guige_id[$_food['id']].='|'.$_food['iid'];
                        $guige_name[$_food['id']].='|'.$_food['title'];
                        $guige_price[$_food['id']].='|'.$_food['price'];
                    }
                }
                $old=0;
                foreach ($food as $_food) {
                    if ($old == $_food['id']) {
                        continue;
                    }else{
                        $old = $_food['id'];
                    }
                    if ($_food['cname'] != $t) {
                        $i++;
                        if ($i > 1) {
                            echo '</div></div>';
                        }
                        echo '<div id="title' . $i
                            . '" class="list_cont"><div class="list_tile"> '
                            . $_food['cname']
                            . '</div><div class="list_right">';
                        $t = $_food['cname'];
                    }
                    $img = $_food['head_img'] == '' ? $_food['img']
                        : $_food['head_img'];

                    if ($_food['status'] == 1) {
                        $wei = '<div class="but no"> 已售完</div>';
                    } else {
                        $wei= '<div class="plus">
                                <a href="javascript:void(0);">
                                    <span><img src="/static/627dc/images/wqw.png"/></span>
                                    
                                </a>
                                 <div class="guige_id" style="display:none">'. $guige_id[$_food['id']] . '</div>
                                 <div class="guige_name" style="display:none">'. $guige_name[$_food['id']] . '</div>
                                 <div class="guige_price" style="display:none">'. $guige_price[$_food['id']] . '</div>
                            </div>';
                    }
                    echo <<<EOD
                    <div class="right_list clearfix">
                     <div class="list_img"><a href="/food/user/detail?id=$_food[id]"><img class="lazy" data-original="$img" src="$img"></a></div>
                            <p><a href="/food/user/detail?id=$_food[id]" class="food_name">$_food[fname]</a></p>
                            <div>已售：$_food[sold_number]份</div>
                            <div class="food_price">单价：<b>￥$_food[price]</b></div>
                            $wei
                    </div>
EOD;

                }

                ?>
                <!--第1个菜单-->
            </div>
        </div>
        </div>
    </div>
    <div class="statement">
        <ul>
            <li class="pitch_on"><a href="#"><img src="/static/627dc/images/nav_11.png"/><span>菜类</span></a></li>
            <li><a href="/food/user/cart"><img src="/static/627dc/images/nav_2.png"/><span>购物车</span></a>
                <div class="data_box"><?=$count?></div>
            </li>
            <li><a href="tel:<?=$shop['contact']?>" onclick="contactUs('<?=$shop['contact']?>')"><img src="/static/627dc/images/nav_4.png"/><span>联系我们</span></a></li>
            <li><a href="/food/user/person"><img src="/static/627dc/images/nav_3.png"/><span>个人中心</span></a>
            </li>
        </ul>
    </div>
    <!--遮罩盒子-->
    <div id="fade"></div>


    <div class="show_box">
        <div class="close_box"><img src="/static/627dc/images/close3.png"/>
        </div>
        <div class="greens_box">
            <dl class="clearfix">
                <dt><img id="food_img" src="/static/627dc/images/1.jpg"/></dt>
                <dd>
                    <h3 id="food_name"> </h3>
                    <span id="food_price"> </span>
                </dd>
            </dl>
        </div>
        <div class="btn_box">
            <h4>规格</h4>
            <ul>
                <div class="select_btn">

                </div>
            </ul>
        </div>
        <div class="modified_box clearfix">
            <dl>
                <dt>购买数量：</dt>
                <dd>
                    <div class="gw_num">
                        <em class="jian">-</em>
                        <input id="gw_num" type="text" value="1" class="num"/>
                        <em class="add">+</em>
                    </div>
                </dd>
            </dl>
        </div>
        <div class="text_box">
            <textarea placeholder="请您输入您的需求" id="xuqiu"></textarea>
        </div>
        <div class="affirm_box">
            <dl class="clearfix">
                <a onclick="buy()">
                    <dt>加入购物车</dt>
                </a>
                <a onclick="buyOne()">
                    <dd>立即购买</dd>
                </a>
            </dl>
        </div>
    </div>

</div>


</body>
<script>

var food_id=0;

    function buy() {
        var id = food_id;//菜品详情信息
        var num=$('#gw_num').val();
        var price=1;//摆设
        var name=$('#food_name').html();
        var text=$('#xuqiu').val();
        if(num>0){
            updateCookie(id,num,price,name,text);
            var my=$(".data_box").html();
            my=parseInt(my)+parseInt(num);
            $(".data_box").html(my);
        }else{
            $('#gw_num').val("1").focus();
        }
        layer.msg('加入购物车成功');
        $('.show_box').hide();
        $('#fade').hide();
    }
    function buyOne(){
        buy();
        window.location.href="/food/user/order?menu="+food_id+",";
    }
    function contactUs(text){
        layer.msg(text);
    }

    function updateCookie(id, num, price, name,text) {	//输入商品id,数量，价格即可
        var has = false;
        var data = $.cookie('cart');
        if (data) {
            data = JSON.parse(data);
            for (var x = 0; x < 999; x++) {
                if (data.cart[x] == undefined)break;
                if (data.cart[x].id == id) {
                    data.cart[x].num += parseInt(num);
                    data.cart[x].text = text;
                    has = true;
                }
            }
            data = JSON.stringify(data);
        }
        if (!has && data == null) {
            data = '{\"cart\":[{\"id\":' + id + ',\"num\":' + num + ',\"price\":' + price + ',\"name\":\"' + name + '\",\"text\":\"' + text + '\"}]}';
        } else {
            if (!has) {
                temp = ',{\"id\":' + id + ',\"num\":' + num + ',\"price\":' + price + ',\"name\":\"' + name + '\",\"text\":\"' + text + '\"}]}';  //从后面插入位移两位
                data = data.replace("]}", temp);
            }
        }
        $.cookie('cart', data, {expires: 1, path: '/'});
    }
</script>

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
        $('.list_menu .li').click(function () {
            var index = $(this).index();
            $('.on').removeClass('on');
            $(this).addClass('on');
        });

        //滚动定位
        $(window).scroll(function () {
            var _top = $(window).scrollTop();
            var _all = -50;
            for (var i = 0; i < $('.list_cont').length; i++) {
                _length = $('.list_cont').eq(i).height();
                if (_all <= _top && _top < (_all + _length)) {
                    $('.list_menu .on').removeClass('on');
                    $('.list_menu .li').eq(i).addClass('on');
                    var _menu = i * 57;
                    $('.list_menu').scrollTop(_menu);

                }
                _all += $('.list_cont').eq(i).height();
            }

        });
    })
</script>

<script type="text/javascript" src="/static/627dc/js/login.js"></script>
</html>

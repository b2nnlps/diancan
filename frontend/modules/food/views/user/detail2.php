<?php
use member\modules\food\models\FoodInfo;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合点餐系统</title>
    <link href="/static/627dc/css/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/static/627dc/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/static/627dc/js/jquery.touchSlider.js"></script>
    <script type="text/javascript" src="/static/627dc/js/pictures.js"></script>
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="/static/627dc/images/fh.png" width="20" height="20"></a></li>
            <p><?=$food['name']?></p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <!--图片轮播 -->
        <!--效果html开始-->
        <div class="main_visual">
            <div class="flicking_con">
                <?php
                $imgs=explode(',',$food['img']);
                for($i=0;$i<count($imgs);$i++){
                    if(strlen($imgs[$i])>3) echo "<a href=\"#\">$i</a>";
                }
                ?>
            </div>
            <div class="main_image">
                <ul>
                    <?php
                    foreach($imgs as $img){
                        if(strlen($img)>3) echo "<li><span><img src='$img'></span></li>";
                    }
                    ?>
                </ul>
                <a href="javascript:;" id="btn_prev"></a> <a href="javascript:;" id="btn_next"></a> </div>
        </div>
        <!--效果html结束-->
        <div class="product">
            <h4><?=$food['name']?></h4>
            <h5>￥<?=$food['price']?></h5>
            <div class="stock_box"><Span>库存：<?=$stock?></Span><span>销量：<?=$food['sold_number']?></span></div>
        </div>
        <div class="Business">
            <a href="#">
                <dl>
                    <dt> <img src="/static/627dc/icon/rh_logo.png"> </dt>
                    <dd>
                        <h4><?=$shop['name']?></h4>
                        <p><?=$shop['description']?></p>
                    </dd>
                    <div class="clear"></div>
                </dl>
            </a> </div>
        <div class="Chika">
            <div class="Chikafusax">
                <a href="javascript:void(-1);" onClick="woaicssq(1)" id="woaicsstitle" class="thisclass">商品详情</a>
                <a href="javascript:void(-1);" onClick="woaicssq(2)" id="woaicsstitle" class="">销售记录</a>
            </div>
        </div>
        <div id="woaicss_con1" style="display:block;">
            <div class="describe">
            <?=$food['description']?>
            </div>
        </div>
        <div id="woaicss_con2" style="display:none;">
            <div class="record">
                <?php
                foreach ($order as $_order){
                    echo " <dl>
                    <dt><img src=\"$_order[headimgurl]\"></dt>
                    <dd>
                        <h4>$_order[nickname]</h4>
                        <span> $_order[created_time]&nbsp;&nbsp;购买：$_order[num] 件</span> </dd>
                    <div class=\"clear\"></div>
                </dl>
                    ";
                }

                ?>

            </div>
        </div>
    </div>
    <div class="bottomMenu clearfix">
        <dl>
            <a href="#">
                <dt><a href="tel:18389957620"><img src="/static/627dc/images/kefu.png">客服</a></dt>
            </a> <a href="shopping_cart.html">
                <dd> <img src="/static/627dc/images/gwc.png">购物车
                    <div id="sing">55</div>
                </dd>
            </a>
        </dl>
        <ul>
            <a href="#">
                <li style=" background-color:#FF8854;">加入购物车</li>
            </a>
            <div class="plus">
                <a href="javascript:void(0);">
                    <li>立即购买</li>
                </a>
            </div>
        </ul>
    </div>
    <!--悬浮菜单：结束-->
    <!---弹出--->
    <div class="show_box">
        <div class="close_box"><img src="/static/627dc/images/close3.png" /></div>
        <div class="greens_box">
            <dl class="clearfix">
                <dt><img src="/static/627dc/images/greens_picture.png" /></dt>
                <dd>
                    <h3>欧洲风情庄园干红葡萄酒</h3>
                    <span>￥68.50-98.00</span> </dd>
            </dl>
        </div>
        <div class="btn_box">
            <h4>规格</h4>
            <ul>
                <div class="select_btn">
                    <div class="norm">
                        <label for="norm1">
                            <input type="radio" name="sex" id="norm1" >大
                        </label>
                        <span class="btn">大</span>
                    </div>
                    <div class="norm">
                        <label for="norm2">
                            <input type="radio" name="sex" id="norm2" checked>中
                        </label>
                        <span class="btn active">中</span>
                    </div>
                    <div class="norm">
                        <label for="norm3">
                            <input type="radio" name="sex" id="norm3">小
                        </label>
                        <span class="btn">小</span>
                    </div>
                </div>
            </ul>
        </div>
        <div class="modified_box clearfix">
            <dl>
                <dt>购买数量：</dt>
                <dd>
                    <div class="gw_num">
                        <em class="jian">-</em>
                        <input type="text" value="1" class="num"/>
                        <em class="add">+</em>
                    </div>
                    <!--<a href="#">-</a><input value="1" type="text" /><a href="#">+</a>-->
                </dd>
            </dl>
        </div>
        <div class="text_box">
            <textarea placeholder="请您输入您的需求"></textarea>
        </div>
        <div class="btn_box1">立即购买</div>
    </div>
    <div id="fade"></div>
</div>
</body>
</html>
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
<script>
    $(".select_btn label").click(function() {
        $(this).siblings("span").addClass("active");
        $(this).parent().siblings("div").find("span").removeClass("active");
    });
</script>

<script>
    function woaicssq(num){
        for(var id = 1;id<=2;id++)
        {
            var MrJin="woaicss_con"+id;
            if(id==num)
                document.getElementById(MrJin).style.display="block";
            else
                document.getElementById(MrJin).style.display="none";
        }
        var zzsc = $(".Chikafusax a");
        zzsc.click(function(){
            $(this).addClass("thisclass").siblings().removeClass("thisclass");
        });
    }
    $(function(){
        var zzsc = $(".Chikafusax a");
        zzsc.click(function(){
            $(this).addClass("thisclass").siblings().removeClass("thisclass");
        });
    });
</script>
<script type="text/javascript" src="js/login.js"></script>
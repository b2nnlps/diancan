<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合点餐系统</title>
    <meta name="csrf-param" content="_csrf-frontend">
    <meta name="csrf-token" content="YUFvSm1URDYDDT8iJ2M2ZA8gJ3g3OxJBWTQwAQENLQUtNFoLGj4HVA==">
    <link href="/static/84dc/css/list_v1.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/static/84dc/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/static/84dc/js/jquery.touchSlider.js"></script>
    <script type="text/javascript" src="/static/84dc/js/pictures.js"></script>
</head>

<body>
<div id="box"><!--头部：开始--->
    <div class="main">
        <!--图片轮播 -->
        <!--效果html开始-->
        <div class="main_visual">
            <div class="flicking_con">
                <?php
                $imgs = explode(',', $food['img']);
                for ($i = 0; $i < count($imgs); $i++) {
                    if (strlen($imgs[$i]) > 3) echo "<a href=\"#\">$i</a>";
                }
                if (!count($imgs))
                    echo "<a href=\"#\">$food[head_img]</a>";
                ?>
            </div>
            <div class="main_image">
                <ul>
                    <?php
                    foreach ($imgs as $img) {
                        if (strlen($img) > 3) echo "<li><span><img src='$img'></span></li>";
                    }
                    if (!count($imgs))
                        echo "<li><span><img src='$food[head_img]'></span></li>";
                    if (count($imgs) > 1)
                        echo '<a id="btn_prev"></a> <a id="btn_next"></a>';
                    ?>
                </ul>
            </div>
        </div>
        <!--效果html结束-->
        <div class="product">
            <h4><?= $food['name'] ?></h4>
            <h5>￥<?= $price ?></h5>

            <div class="stock_box"><Span>库存：<?= $stock ?></Span><span>销量：<?= $food['sold_number'] ?></span></div>
        </div>
        <div class="Business">
            <a href="#">
                <dl class="clearfix">
                    <dt><img src="<?= $shop['img'] ?>"></dt>
                    <dd>
                        <h4><?= $shop['name'] ?></h4>

                        <p><?= $shop['description'] ?></p>
                    </dd>
                </dl>
            </a></div>
        <div class="Chika">
            <div class="Chikafusax">
                <a href="javascript:void(-1);" onClick="woaicssq(1)" id="woaicsstitle" class="thisclass">商品详情</a>
                <a href="javascript:void(-1);" onClick="woaicssq(2)" id="woaicsstitle" class="">销售记录</a>
            </div>
        </div>
        <div id="woaicss_con1" style="display:block;">
            <div class="describe">
                <?= $food['description'] ?>
            </div>
        </div>
        <div id="woaicss_con2" style="display:none;">
            <div class="record">
                <?php
                foreach ($order as $_order) {
                    echo " <dl class='clearfix'>
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
    <?= $this->render('footer') ?>
    <!--悬浮菜单：结束-->
</div>
<div id="big" style="display: block;"></div>
</body>
</html>

<script>
    $("#big").css('height', $(window).height() - $("#box").height() + 10);
    function woaicssq(num) {
        for (var id = 1; id <= 2; id++) {
            var MrJin = "woaicss_con" + id;
            if (id == num)
                document.getElementById(MrJin).style.display = "block";
            else
                document.getElementById(MrJin).style.display = "none";
        }
        var zzsc = $(".Chikafusax a");
        zzsc.click(function () {
            $(this).addClass("thisclass").siblings().removeClass("thisclass");
        });
    }
    $(function () {
        var zzsc = $(".Chikafusax a");
        zzsc.click(function () {
            $(this).addClass("thisclass").siblings().removeClass("thisclass");
        });
    });
</script>
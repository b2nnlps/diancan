
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合快餐</title>
    <link href="/static/food/css/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/static/food/js/jquery-1.8.3.min.js"></script>
</head>

<body>
<div class="box"><!--头部：开始--->

    <div class="greens_picture">
        <!--图片转播-->
        <div id="demo01" class="flexslider">
            <ul class="slides">
                <?php
                    $imgs=explode(',',$food['img']);
                    foreach($imgs as $img){
                        if(strlen($img)>3) echo '<li><div class="img"><img src="'.$img.'"/></div></li>';
                    }
                ?>

            </ul>
        </div>
        <!--flexslider end-->
        <div class="Dish_names">
            <h4><?=$food['name']?></h4><span>￥<?=$food['price']?></span><em>/标准</em></div>

        <div class="other">
            <h4>详细描述</h4>
            <p><?=$food['description']?></p>
        </div>
    </div>
    <div class="affirm"><a style="display: block;" href="javascript:history.go(-1)">返回首页</a></div>
</div>
<script type="text/javascript" src="/static/food/js/slider.js"></script>
<script type="text/javascript">
    $(function(){

        $('#demo01').flexslider({
            animation: "slide",
            direction:"horizontal",
            easing:"swing"
        });

        $('#demo02').flexslider({
            animation: "slide",
            direction:"vertical",
            easing:"swing"
        });

    });
</script>
</body>
</html>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <link href="/static/627dc/css/shop.css" rel="stylesheet" type="text/css">
    <script src="/static/food/js/jquery-1.11.2.js"></script>
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="/static/627dc/icon/return1.png"></a></li>
            <p>商品管理列表</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
       <div class="seek_box">
          <div class="seek clearfix">
           <input type="text" id="name" placeholder="请输入您查询的商品名称">
           <a href="#" onclick="searchFood()"><img src="/static/627dc/icon/ssimg.png"></a>
          </div>
        </div>
        <div class="gl_list_box">
            <div class="gl_list">

                <?php
                    foreach ($food as $_food){
                        echo <<<EOD
    <dl> <dt><a href="/food/user/detail?id=$_food[id]"><img src="$_food[head_img]" alt="只"></a></dt>
                        <dd>
                            <h3> <a href="/food/user/detail?id=$_food[id]">$_food[name]</a></h3>
                            <span>销售量：$_food[sold_number]</span><span>库存:<em class="stock">???</em></span>
                            <h5>￥<em class="price">￥$_food[price]/</em></h5>
                        </dd>
                        <div class="clear"></div>
                    <div class="alterdiv"><a href="/food/admin/food-update?food_id=$_food[id]"><img src="/static/627dc/icon/bj.png"></a></div>
                </dl>
EOD;

                    }
                ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
function searchFood(){
    var name=$("#name").val();
    window.location.href="/food/admin/food-list?name="+name;
}
    </script>
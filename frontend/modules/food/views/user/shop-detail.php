<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合点餐系统</title>
    <meta name="csrf-param" content="_csrf-frontend">
    <meta name="csrf-token" content="YUFvSm1URDYDDT8iJ2M2ZA8gJ3g3OxJBWTQwAQENLQUtNFoLGj4HVA==">
    <link href="/static/84dc/css/list_v1.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="/static/84dc/images/fh.png" width="20" height="20"></a>
            </li>
            <p><?= $shop['name'] ?></p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="nav_box">
            <ul class="clearfix">
                <a href="index_v2.html">
                    <li>菜品</li>
                </a>
                <li><span>店铺</span></li>
                <li>评论</li>
            </ul>
        </div>
        <div style="background-color:#EDF1F1; height:10px;"></div>
        <div class="call_names">
            <dl class="clearfix">
                <dt><img src="<?= $shop['img'] ?>"></dt>
                <dd>
                    <h4><?= $shop['name'] ?></h4>

                    <div>已售出<span><?= $sold ?></span>单</div>
                    <em><?= $shop['description'] ?></em>
                </dd>
            </dl>
        </div>
        <div style="background-color:#EDF1F1; height:10px;"></div>
        <div class="store_xq">
            <a href="#">
                <div class="bj_div"><img src="/static/84dc/icon/map1.png"><?= $shop['address'] ?></div>
            </a>

            <div><img src="/static/84dc/icon/time12.png">营业时间：<?= $shop['begin_time'] . '-' . $shop['end_time'] ?></div>
            <a href="tel:0898-62922223">
                <div class="bj_div"><img src="/static/84dc/icon/dhimg.png">服务热线：<?= $shop['contact'] ?></div>
            </a>
        </div>
        <div style="background-color:#EDF1F1; height:10px;"></div>
        <div class="privilege">
            <ul>

            </ul>
        </div>

        <?= $this->render('footer') ?>

    </div>
</div>
</body>
</html>
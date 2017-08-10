<?php
$jssdk = new \common\wechat\JSSDK();
$signPackage = $jssdk->GetSignPackage();

?>
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

    <div class="main">

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

            <div><img
                    src="/static/84dc/icon/time12.png">营业时间：<?= substr($shop['begin_time'], 0, 5) . '-' . substr($shop['end_time'], 0, 5) ?>
            </div>
            <a href="tel:<?= $shop['contact'] ?>">
                <div class="bj_div"><img src="/static/84dc/icon/dhimg.png">服务热线：<?= $shop['contact'] ?></div>
            </a>
        </div>
        <div style="background-color:#EDF1F1; height:10px;"></div>
        <div class="privilege">
            <ul>

            </ul>
        </div>

        <div class="navigate">
            <ul>
                <a onclick="closeWin()">
                    <li><img src="/static/84dc/icon/dcimg.png">点餐</li>
                </a>
                <!--        <a ><li><img src="/static/84dc/icon/yyimg.png">预约</li></a>-->
                <a href="/food/user/my-order">
                    <li><img src="/static/84dc/icon/ddimg.png">订单</li>
                </a>
                <a href="/food/user/person">
                    <li><img src="/static/84dc/images/nav_3.png">个人中心</li>
                </a>
            </ul>
        </div>

    </div>
</div>
<div id="big" style="display: block;"></div>
</body>
</html>
<script type="text/javascript" src="/static/84dc/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/static/84dc/js/layer/layer.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    /**
     * 转发封面及简介
     * @returns {undefined}
     */
    var dataForShare = {
        weixin_icon: "<?=$shop['img']?>",
        weixin_url: "http://ms.n39.cn/food/user/shop-info?shopId=<?=$shop['id']?>",
        weibo_icon: "<?=$shop['img']?>",
        url: "http://ms.n39.cn/food/user/shop-info?shopId=<?=$shop['id']?>",
        title: "<?=$shop['name']?>",
        description: "<?=$shop['description']?>"
    };
    var appId = "<?=$signPackage["appId"]?>";
    var timestamp = "<?=$signPackage["timestamp"]?>";
    var nonceStr = "<?=$signPackage["nonceStr"]?>";
    var signature = "<?=$signPackage["signature"]?>";

</script>
<script type="text/javascript" src="/static/84dc/js/wx_share.js"></script>
<script>
    $("#big").css('height', $(window).height() - $("#box").height() + 1);
    function closeWin() {
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
        window.location.href = '/food/user/index';
    }
</script>
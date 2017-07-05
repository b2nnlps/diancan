<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <link href="/static/627dc/css/shop.css" rel="stylesheet" type="text/css">
    <script src="/static/food/js/jquery-1.11.2.js"></script>
    <script src="/js/layer/layer.js"></script>
</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="/food/user/person"><img src="/static/627dc/icon/return1.png" width="30" height="30"></a></li>
            <p>店铺管理</p>
            <li id="save" style=" font-size:14px; color:#FF4A83; "></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <form method="post">
        <div class="shop_updtate_box">
            <div class="shop_updtate clearfix">
                <span>店铺名称</span>
                <em><input type="text" id="name" name="Shop[name]" placeholder="请输入店名称" value="<?=$shop['name']?>"></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>店铺地址</span>
                <em><input type="text" id="address" name="Shop[address]" placeholder="请输入店地址" value="<?=$shop['address']?>"></em>
            </div>
            <div class="shop_updtate clearfix">
                <span>联系电话</span>
                <em><input type="text" id="contact" name="Shop[contact]" placeholder="请输入联系电话" value="<?=$shop['contact']?>"></em>
            </div>
<!--            <div class="shop_updtate clearfix">-->
<!--                <span>营业时间</span>-->
<!--                <em><input type="text" id="open_hours" placeholder="请输入营业时间" value="每天8:00至22:00"></em>-->
<!--            </div>-->
            <div class="shop_updtate clearfix">
                <span>简&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;述</span>
                <em><textarea id="brief" name="Shop[description]"><?=$shop['description']?></textarea></em>
            </div>

        </div>
        <input type="hidden" name="originator" id="originator" value="645722">
        <div class="submit"><button id="conf">提交</button></div>
    </div>
    </form>
</div>
</body>
</html>
<script>
   if(<?=$mess?>) layer.msg('保存成功');
</script>
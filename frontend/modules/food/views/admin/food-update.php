<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <link href="/static/627dc/css/shop.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="/static/627dc/icon/return1.png" width="30" height="30"></a></li>
            <p>更新商品</p>
            <li id="save" style=" font-size:14px; color:#FF4A83; "></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
      <div class="shop_updtate_box">
        <div class="shop_updtate clearfix">
            <span>商品名称</span>
            <em><?=$food['name']?></em>
        </div>
        <div class="shop_updtate clearfix">
            <span>库&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;存</span>
            <em><input type="text" placeholder="请输入库存数量"></em>
        </div>
        <div class="shop_updtate clearfix">
            <span>是否上架</span>
            <em>
               <select>
                  <option>是</option>
                  <option>否</option>
               </select>
            </em>
        </div> 
        <div class="shop_updtate clearfix">
            <span>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</span>
            <em><textarea></textarea></em>
        </div>
      </div>
      <div class="submit"><button id="conf">提交</button></div>
    </div>
</div>
</body>
</html>

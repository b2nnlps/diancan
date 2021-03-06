<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>容合点餐系统</title>
<link href="/static/627dc/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="/food/user/person"><img src="/static/627dc/images/fh.png" width="20" height="20"></a></li>
            <p><?=$mess?></p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="payment_success">
            <img src="/static/627dc/images/cgimg.png">
            <h3><?=$mess?></h3>
        </div>
        <div class="butt_box">
           <dl class="clearfix">
               <dt><a href="/food/user/index">返回首页</a></dt>
               <dd><a href="/food/user/person">个人中心</a></dd>
           </dl>
        </div>
        <div class="clue_box"><span>温馨提示：</span>绑定成功后将拥有管理商家的相关权限！</div>
   </div>
   <div class="footer"><a href="#">容合<img src="/static/627dc/images/logo.png" width="20" height="20"/>商圈</a></div>
</div>
</body>
</html>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>容合商圈</title>
<link href="/static/627dc/css/integral.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="/static/627dc/images/fh.png" width="20" height="20"></a></li>
            <p>积分商城</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
       <div class="inte_box">
          <div class="inte_top">
            <h3><span><?=$u['realname']?></span> ，您好  您有<strong> <?=$u['score']?> </strong>积分</h3>
            <ul class="clearfix">
                <a href="jf_order.html"><li style="border-right:1px solid #DEDEDE;">兑换订单</li></a>
                <a href="jf_record.html"><li>积分记录</li></a>
            </ul>
          </div>
          <div class="seek_box"></div>
          <div class="inte_list">
              <?php
              foreach ($food as $_food){
                  if($_food['score']){
                      echo <<<EOD
 <a href="/food/user/j-detail?id=$_food[iid]">
              <dl class="clearfix">
                  <dt><img src="$_food[head_img]"></dt>
                  <dd>
                     <h5>$_food[fname]-$_food[title]</h5>
                     <span><strong>$_food[score]</strong>积分</span><em>已兑换<strong>$_food[score_number]</strong>件</em>
                  </dd>
              </dl>
            </a>
EOD;

                  }
              }
              ?>
          </div>
       </div>
       <div class="load_more"><a href="#">加载更多</a></div>
   </div>
</div>
</body>
</html>

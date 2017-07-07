<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>容合商圈</title>
<link href="/static/627dc/css/integral.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/static/627dc/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/static/627dc/js/jquery.touchSlider.js"></script>
<script type="text/javascript" src="/static/627dc/js/pictures.js"></script>
</head>

<body>
<div class="box"><!--头部：开始--->
  <div class="Favorites">
    <ul>
      <li><a href="javascript:history.go(-1)"><img src="/static/627dc/images/fh.png" width="20" height="20"></a></li>
      <p>商品详情</p>
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
      <h4><?=$food['name'].'-'.$info['title']?></h4>
      <h5><span>兑换价<strong><?=$info['score']?></strong>积分</span><em>我的积分<strong><?=$u['score']?></strong></em></h5>
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
        <a href="javascript:void(-1);" onClick="woaicssq(2)" id="woaicsstitle" class="">兑换记录</a> 
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
                        <span> $_order[created_time]&nbsp;&nbsp;兑换：$_order[num] 件</span> </dd>
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
    
      <dt>
        <div class="modified_box clearfix">
        <ol>
          <h4>数量：</h4>
          <p>
             <div class="gw_num">
                  <em class="jian">-</em>
                  <input type="text" value="1" class="num"/>
                  <em class="add">+</em>
              </div>
           </p>
        </ol>
      </div>
      </dt>
      <dd>库存<strong><?=$stock?></strong>件</dd>
    </dl>
    <ul>
        <a href="jf_dh.html">
            <li>立即兑换</li>
        </a>
    </ul>
  </div>
  <!--悬浮菜单：结束-->
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
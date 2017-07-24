<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>点菜</title>
<link href="/static/admin/css/list.css" rel="stylesheet">
<link href="/static/admin/css/weui.css" rel="stylesheet">
<script type="text/javascript" src="/static/admin/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/static/food/js/jquery.lazyload.js?v=1.9.1"></script>
</head>
<body>
<div class="box"><!--头部：开始--->
  <div class="main">
      <?php
      $cname="";
      foreach($food as $_food){
          if($cname!=$_food['cname']){if($cname!="")echo '</div>'; $cname=$_food['cname']; echo '<div class="list_title">'.$cname.'</div><div class="listbox">';}
          $img=$_food['img'];
          if(strlen($_food['head_img'])>5) $img=$_food['head_img'];
          $text=$_food['status']==0?'checked="checked"':'';
          echo <<<EOD
              <div class="list clearfix">
                <a href="/food/user/detail?id=$_food[id]"><img class="lazy" data-original="$img"></a>
              <p><a href="/food/user/detail?id=$_food[id]">$_food[fname]</a></p>
              <div><b>￥$_food[price]</b>/份</div>
              <div class="down clearfix"><h3>上架</h3>
                   <input class="weui_switch" type="checkbox" $text value="$_food[id]">
              </div>
          </div>
EOD;

      }
      ?>

             
             
     </div>
    <br><br><br><br>
     <div class="putaway">
        <dl class="clearfix">
            <a href="/food/admin/shop-order"><dt>订单</dt></a>
            <a onclick="Up()"><dt>上下架</dt></a>
             <a onclick="Check()"><dd>提交修改</dd></a>
        </dl>
     </div>                
    </div>
</body>
<script>

    $(document).ready(function() {
        $("img.lazy").lazyload({threshold: 200});
    });

    var isUp=1;
	function Up(){
        $("input").each(function(){
            if(isUp)
              $(this).attr("checked","checked");
            else
                $(this).attr("checked",false);
        });
        if(isUp) isUp=0;else isUp=1;
	}

    function Check(){
        var data="";
        $("input").each(function(){
            var check= $(this).attr("checked");
            var id= $(this).attr("value");
            if(check=="checked"){
                data=data+'f'+id+'=0&';
            }else{
                data=data+'f'+id+'=1&';
            }
           // data=data+'f'+id+'='+ check ? 0 : 1;
        });

        $.ajax({ url: "/food/admin/admin-post", data, success: function(){
            alert("修改成功");
        }});
    }
</script>
</html>
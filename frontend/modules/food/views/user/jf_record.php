<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <link href="/static/627dc/css/integral.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="/static/627dc/images/fh.png" width="20" height="20"></a></li>
            <p>积分记录</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
       <div class="dh_box">
          <ul>
             <li><time style="color:#000; font-size:16px;">时间</time><span style="color:#000;font-size:16px;">店家</span><em style="color:#000;font-size:16px;">积分</em></li>
              <?php
                foreach ($record as $_record){
                    echo "<li><time>$_record[created_time]</time><span>$_record[name]</span><em>+$_record[total]</em></li>";
                }
                if(!count($record)){
                    echo '<div class="zw_box">
          <img src="/static/627dc/images/zwjlimg.png">
          <p>暂无记录！</p>
       </div>';
                }
              ?>
          </ul>
       </div>

    </div>
</div>
</body>
</html>
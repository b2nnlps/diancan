<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>滚屏加载--无刷新动态加载数据技术的应用</title>
    <style type="text/css">
         #container{margin:10px auto;width: 660px; border: 1px solid #999;}
        .single_item{padding: 20px; border-bottom: 1px dotted #d3d3d3;}
        .realname{position: absolute; left: 0px; font-weight:bold; color:#39f}
        .date{position: absolute; right: 0px; color:#999}
        .phone{line-height:20px; word-break: break-all;}
        .element_head{width: 100%; position: relative; height: 20px;}
        .nodata{display:none; height:32px; line-height:32px; text-align:center; color:#999; font-size:14px}
    </style>
    <script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>

</head>

<body>
<div id="container">
    1234556
    <?php
    $connection = Yii::$app->db;
    $sql = "select * from  {{%sys_member}} order by created_time desc limit 0,20";
    $command=$connection->createCommand($sql);
    $user=$command->queryAll();
    foreach ($user as $_v){
        ?>
        <div class="single_item">
            <div class="element_head">
                <div class="date"><?=$_v['created_time']?></div>
                <div class="realname"><?=$_v['realname']?></div>
            </div>
            <div class="phone"><?=$_v['phone']?></div>
        </div>
    <?php } ?>
</div>
<div class="nodata"></div>
</body>
<script type="text/javascript">
    $(function(){
        var winH = $(window).height(); //页面可视区域高度
        var i = 1; //设置当前页数
        $(window).scroll(function () {
            var pageH = $(document.body).height();
            var scrollT = $(window).scrollTop(); //滚动条top
            var aa = (pageH-winH-scrollT)/winH;
            if(aa<0.02){
                $.getJSON("<?=Yii::$app->urlManager->createAbsoluteUrl(['demo/more'])?>",{page:i},function(json){
                    if(json){
                        var str ='';
                        $.each(json,function(index,array){
//                            alert(str);
                            //方法一：
                            var str = '<div class="single_item"><div class="element_head">';
                            var str = str+'<div class="date">'+array['date']+'</div>';
                            var str = str+'<div class="realname">'+array['realname']+'</div>';
                            var str = str+ '</div><div class="phone">'+array['phone']+'</div></div>';
                            //方法二：
//                            var str = "<div class=\"single_item\"><div class=\"element_head\">";
//                            var str = str + "<div class=\"date\">"+array['date']+"</div>";
//                            var str = str + "<div class=\"realname\">"+array['realname']+"</div>";
//                            var str = str + "</div><div class=\"phone\">"+array['phone']+"</div></div>";
                            //方法三：
                            //    str+='<div class="single_item"><div class="element_head"><div class="date">'+array['date']+'</div><div class="realname">'+array['realname']+'</div></div><div class="phone">'+array['phone']+'</div></div>';
                            $("#container").append(str);
                        });
                        i++;
						
                    }else{
                        $(".nodata").show().html("别滚动了，已经到底了。。。");
                        return false;
                    }
                });
            }
        });
    });
</script>
</html>

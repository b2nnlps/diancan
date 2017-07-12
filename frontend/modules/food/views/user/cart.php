<?php
use member\modules\food\models\Food;
use member\modules\food\models\FoodInfo;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合点餐系统</title>
    <link href="/static/627dc/css/style.css" rel="stylesheet" type="text/css">
    <link href="/static/627dc/css/demo.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/static/627dc/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/static/food/js/jquery.cookie.js"></script>
    <script src="/js/layer/layer.js"></script>
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="/food/user/index"><img src="/static/627dc/images/fh.png" width="20" height="20"></a></li>
            <p>购物车</p>
            <li><a onclick="edit()">编辑</a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="goods_list">
            <?php
            $total_price=0;
            $total_number=0;
            $text='';$foods=[];
            if(!count($cart))
                echo '<div class="zw_box">
                  <img src="/static/627dc/images/zwjlimg.png">
                  <p>暂无记录！</p>
                </div>';
            for($i=0;$i<count($cart);$i++){
                if($cart[$i]['num']<=0) continue;
                $info=FoodInfo::findOne($cart[$i]['id']);
                if($info){
                    if(!isset($food[$info['food_id']])){//免去重复查询数据库
                        $foods[$info['food_id']]=Food::findOne($info['food_id']);
                    }
                    $food=$foods[$info['food_id']];
                    $total_number+=$cart[$i]['num'];
                    $total_price+=$info['price']*$cart[$i]['num'];
            ?>
		
			<dl class="clearfix">
              <dt><a href="/food/user/detail?id=<?=$food['id']?>"><img src="<?=$food['head_img']?>"></a></dt>
              <dd>
                 <h4><?=$food['name'].'-'.$info['title']?></h4>
                <span><?=$cart[$i]['text']?></span>
                <span class="colour" style=" font-size:14px;">￥<?=$info['price']?></span>
                <div class="property_box">
                    <div class="gw_num">
                        <em class="jian">-</em>
                        <input type="text" value="<?=$cart[$i]['num']?>" class="num"/>
                        <em class="add">+</em>
                        <div class="my_id" style="display: none"><?=$info['id']?></div>
                        <div class="my_price" style="display: none"><?=$info['price']?></div>
                    </div>
                </div>
              </dd>
              <div class="demo">
                <div class="col">
                    <div class="opt">
                        <input class="magic-checkbox" type="checkbox" name="cart" id="c<?=$i?>">
                        <label for="c<?=$i?>"></label>
                    </div>
                </div>
             </div>
          </dl>

            <?php
                }
            }
            ?>

            <br><br><br><br>

        </div>
        <div class="clearing_box clearfix">

            <div class="clearing_left">
                <dl class="clearfix">
                    <dt>
                    <div class="demox">
                        <div class="col">
                            <div class="opt">
                                <input class="magic-checkbox" type="checkbox" name="layout" onclick="check(this)" id="all">
                                <label for="all" class="all">全选</label>
                            </div>
                        </div>
                    </div>
                    </dt>
                    <dd>合计：<span id="total">￥0</span></dd>
                </dl>
            </div>
            <a onclick="post()"><div class="clearing_right">前往结算</div></a>

           <div class="delete_box">
              <dl class="clearfix">
                  <dt>
                  <div class="demox">
                    <div class="col">
                        <div class="opt">
                            <input class="magic-checkbox" type="checkbox" name="layout" onclick="check(this)" id="all2">
                            <label for="all" class="all">全选</label>
                        </div>
                    </div>
                  </div>
                  </dt>
                  <dd onclick="del()">删除</dd>
              </dl>
           </div>


        </div>
    </div>
</div>
<script>
$(".select_btn label").click(function() {
    $(this).siblings("span").addClass("active");
    $(this).parent().siblings("div").find("span").removeClass("active");
}); 
</script>

<script>

	$(document).ready(function(){
		//加的效果
		$(".add").click(function(){
            var n=$(this).prev().val();
            var num=parseInt(n)+1;
            if(num==0){ return;}
            $(this).prev().val(num);
            var id=$(this).parent().find(".my_id").html();
            var price=$(this).parent().find(".my_price").html();
            updateCookie(id,num);
            getTotal();
		});
		//减的效果
		$(".jian").click(function(){
            var n=$(this).next().val();
            var num=parseInt(n)-1;
            var id=$(this).parent().find(".my_id").html();
            var price=$(this).parent().find(".my_price").html();
            var my=$(this).parent().parent().parent().parent();
            if(num<=0){
                if(confirm("要删除该商品吗？")){
                    my.slideUp(800,function(){
                        my.remove();
                    });
                }else{
                    return;
                }
            }
		    $(this).next().val(num);
            updateCookie(id,num);
            getTotal();
		});
	})
	//全选
function check(all) {
    if (all.checked) {
        $(".goods_list :checkbox").prop("checked", true);
        $(".all").prop("checked", true);
        $("#all").prop("checked",true);
        $("#all2").prop("checked",true);
    } else {
        $(".goods_list :checkbox").prop("checked", false);
        $(".all").prop("checked", false);
        $("#all").prop("checked",false);
        $("#all2").prop("checked",false);
    }
    getTotal();
}
    $(".goods_list :checkbox").click(function(){
        allchk();
        getTotal();
    });
    function allchk(){
        var chknum = $(".goods_list :checkbox").size();//选项总个数
        var chk = 0;
        $(".goods_list :checkbox").each(function () {
            if($(this).prop("checked")==true){
                chk++;
            }
        });
        if(chknum==chk){//全选
            $("#all").prop("checked",true);
            $("#all2").prop("checked",true);
        }else{//不全选
            $("#all").prop("checked",false);
            $("#all2").prop("checked",false);
        }
    }
var ok=true;
function edit(){
	    if(ok){
            $(".clearing_left").hide();
            $(".clearing_right").hide();
            ok=false;
        }else{
            $(".clearing_left").show();
            $(".clearing_right").show();
            ok=true;
        }
}
function getTotal(){//统计选中的菜品的价格
    var total=0;
    $(".goods_list :checkbox").each(function () {
        if($(this).prop("checked")==true){
            var parent=$(this).parent().parent().parent().parent();
            var my_price=parent.find(".my_price").html();
            var my_num=parent.find(".num").val();
            total+=parseFloat(my_price)*parseFloat(my_num);
        }
    });
    $("#total").html("￥"+total);
}
function post(){//提交选中的菜品
    var food='';
    $(".goods_list :checkbox").each(function () {
        if($(this).prop("checked")==true){
            var parent=$(this).parent().parent().parent().parent();
            var my_id=parent.find(".my_id").html();
            food+=my_id+',';
        }
    });
    if(food)
        window.location.href='/food/user/order?menu='+food;
    else
        layer.msg('您还未勾选菜品');
}
function del(){
    $(".goods_list :checkbox").each(function () {
        if($(this).prop("checked")==true){
            var parent=$(this).parent().parent().parent().parent();
            var id=parent.find(".my_id").html();
                parent.slideUp(800,function(){
                    parent.remove();
                });
                updateCookie(id, 0);
        }
    });
    getTotal();
}
    function updateCookie(id, num) {	//输入商品id,数量，价格即可
        var data = $.cookie('cart');
        if (data) {
            data = JSON.parse(data);
            for (var x = 0; x < 999; x++) {
                if (data.cart[x] == undefined)break;
                if (data.cart[x].id == id) {
                    data.cart[x].num = parseInt(num);
                }
            }
            data = JSON.stringify(data);
        }
        $.cookie('cart', data, {expires: 1, path: '/'});
    }
//防止重刷
getTotal();
</script>
</body>
</html>
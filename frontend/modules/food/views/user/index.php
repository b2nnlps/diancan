<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>点菜</title>
    <link href="/static/food/css/list.css" rel="stylesheet">
    <script src="/static/food/js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="/static/food/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/static/food/js/jquery.lazyload.js?v=1.9.1"></script>

</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="main">
        <div class="list_relative">
            <!--left menu-->
            <div class="list_menu">
                <?php
                $t="";$i=0;
                foreach($food as $_food){
                    if($_food['cname']!=$t){$i++; $str=$i==1?'li on':'li'; echo '<div class="'.$str.'"><a href="#title'.$i.'">'.$_food['cname'].'</a></div>'; $t=$_food['cname']; }
                }
                ?>
                <div style=" padding-bottom:50px;"></div>
            </div>
            <?php
                $i=0;$t="";$end=false;
                foreach($food as $_food){
                    if($_food['cname']!=$t){$i++; if($i>1){echo '</div></div>'; } echo '<div id="title'.$i.'" class="list_cont"><div class="list_tile"> '.$_food['cname'].'</div><div class="list_right">';$t=$_food['cname'];}
                    $img=$_food['head_img']==''?$_food['img']:$_food['head_img'];
                    $img = str_replace(".jpg", "_thumb.jpg", $img);

                    echo <<<EOD

                    <div class="right_list clearfix">
                        <a href="/food/user/detail?id=$_food[id]"><img class="lazy" data-original="$img"></a>
                        <p><a href="/food/user/detail?id=$_food[id]">$_food[fname]</a></p>
                        <div><b>￥$_food[price]</b></div>
                        <div class="plus">
                              <span class="addFirst">+</span>
                            </div>
                        <div id="f_id" style="display:none">$_food[id]</div>
                    </div>
EOD;
                }
            ?>

        </div>
    </div>
    <br><br><br><br><br>
            <!--right end-->
        </div>
    </div>
    <div class="cartpopup" style="display:none">
        <h4><img src="/static/food/images/Cart1.png" width="20" height="20"/><span>购物车</span> <button onclick="clearCart()">清空</button><a href="#" onclick="showCart()"><img src="/static/food/images/close1.png" width="20" height="20"/></a></h4>
        <ul id="cartData">

        </ul>
    </div>
<!---加入购物车成功后提示指向：开始--->
<div id="tip">成功加入购物车！</div>
<!------>
<div class="personage"><a href="/food/user/my-order"><img src="/static/food/images/personage.png" /></a></div>
    <div class="statement">
        <dl class="clearfix">
            <dt class="clearfix" onclick="showCart()"><div id="icon-cart"><img src="/static/food/images/Cart.png" width="30" height="30" /></div><span id="total_num">0</span>项目，共<span id="total_price">￥0</span></dt>
            <dd><a href="/food/user/order">选好了</a></dd>
        </dl>
    </div>
</div>

<div class="shade"></div>
</body>
<script type="text/javascript" src="/static/food/js/jquery.fly.min.js"></script>
<script>
    $(document).ready(function(){
        $("img.lazy").lazyload({threshold: 200});
        $('.list_menu .li').click(function(){
            var index = $(this).index();
            $('.on').removeClass('on');
            $(this).addClass('on');
        });

        //滚动定位
        $(window).scroll(function(){
            var _top =$(window).scrollTop();
            var _all = -50;
            for(var i = 0;i<$('.list_cont').length;i++){
                _length = $('.list_cont').eq(i).height();
                if(_all<=_top&&_top<(_all+_length)){
                    $('.list_menu .on').removeClass('on');
                    $('.list_menu .li').eq(i).addClass('on');
                    var _menu = i*57;
                    $('.list_menu').scrollTop(_menu);

                }
                _all += $('.list_cont').eq(i).height();
            }

        });

        var offset = $("#icon-cart").offset();
        $(".addFirst").click(function(event){

            var data=$(this).parent().parent()
            var name=( data.find('a').text())
            var price=( data.find('b').text())
            var id=( data.find('#f_id').text())
            price=price.replace("￥","")
            update(id,1,price,name);
            total_num+=1; total_price+=parseFloat(price);
            cartCount();

            var img = $(this).parent().children('img').attr('src');//获取当前点击图片链接
            var flyer = $('<img class="flyer-img" src="'+'">');//抛物体对象
            flyer.fly({
                start: {
                    left: event.clientX, //抛物体起点横坐标
                    top: event.clientY////抛物体起点纵坐标
                },
                end: {
                    left: offset.left + 10, //抛物体终点横坐标
                    top: offset.top + 10 //抛物体终点纵坐标
                },
                onEnd: function() {
                    $("#tip").show().animate({width: '200px'}, 300).fadeOut(3000);//成功加入购物车动画效果
                    this.destory();//销毁抛物体
                }
            });
            $(".cartpopup").slideUp(1000);
        });

        $(".shade").click(function() {
            $(".cartpopup").slideUp(1000);
            $(".shade").fadeOut(1000);
        });


        cartData();
    });

    var total_num= 0,total_price=0;

    function clearCart(){
        $.cookie('cart', null, { expires: 0, path: '/' });
        total_num= 0;
        total_price=0;
        cartCount();
        $(".cartpopup").slideToggle(1000);
        $(".shade").fadeToggle();
    }

    function cartCount(){
        $("#total_num").html(total_num)
        $("#total_price").html("￥"+total_price.toFixed(2))
    }

    function update(id,num,price,name){	//输入商品id,数量，价格即可
        var has=false;
        var data=$.cookie('cart');
        if(data){
            data=JSON.parse(data);
            for(var x=0;x<999;x++){
                if(data.cart[x]==undefined)break;
                if(data.cart[x].id==id){data.cart[x].num+=num; has=true;}
            }
            data=JSON.stringify(data);
        }
        if(!has && data==null){
            data='{\"cart\":[{\"id\":'+id+',\"num\":'+num+',\"price\":'+price+',\"name\":\"'+name+'\"}]}';
        }else{
            if(!has){
                temp=',{\"id\":'+id+',\"num\":'+num+',\"price\":'+price+',\"name\":\"'+name+'\"}]}';  //从后面插入位移两位
                data=data.replace("]}",temp);
            }
        }
        $.cookie('cart', data, { expires: 1, path: '/' });
    }

    function cartData(){
        var ui=$("#cartData");ui.html("");
        var data=$.cookie('cart');
        total_num=0;total_price=0;
        if(data){
            data=JSON.parse(data);
            for(var x=0;x<999;x++){
                if(data.cart[x]==undefined)break;
                if(data.cart[x].num>0){
                    var total=data.cart[x].price * data.cart[x].num;
                    ui.append("<li class=\"clearfix\"><p>"+data.cart[x].name+"</p><span>￥"+data.cart[x].price+"</span><div class=\"fied\" style=\"margin-bottom:10px;\"><div class=\"gw_num\"> <em class=\"jian\">-</em> <input type=\"text\" value=\""+data.cart[x].num+"\" class=\"num\" readonly=\"readonly\"/> <em class=\"add\">+</em><div id=\"f_id\" style='display: none'>"+data.cart[x].id+"</div><div id=\"f_price\" style='display: none'>"+data.cart[x].price+"</div></div></div></li>");
                    total_num+=data.cart[x].num;
                    total_price+=data.cart[x].num*data.cart[x].price;
                }
            }
        }
        cartCount();
        $(".add").click(function(){
            var n=$(this).prev().val();
            var num=parseInt(n)+1;
            if(num<0){ return;}
            $(this).prev().val(num);
            var data=$(this).parent()
            var id=( data.find('#f_id').text())
            var price=( data.find('#f_price').text())
            update(id,1,price,"");
            total_num+=1; total_price+=parseFloat(price);
            cartCount();
        });
        //减的效果
        $(".jian").click(function(){
            var n=$(this).next().val();
            var num=parseInt(n)-1;
            if(num<0){ return;}
            $(this).next().val(num);
            var data=$(this).parent()
            var id=( data.find('#f_id').text())
            var price=( data.find('#f_price').text())
            update(id,-1,price,"");
            total_num+=-1; total_price+=-parseFloat(price);
            cartCount();
        });
    }

    function showCart(){
        cartData();
        $(".cartpopup").slideToggle(1000);
        $(".shade").fadeToggle();

    }
</script>
</html>

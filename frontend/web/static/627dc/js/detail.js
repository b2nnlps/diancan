$(function () {
    H_login = {};
    H_login.openLogin = function(){
        $('.plus a').click(function(){
            $('.show_box').show();
            $('#fade').show();
            var ba= $(this).parent().parent();
            $("#gw_num").val(1);
            checkGood(ba);
            go=true;
            $(".btn_box1").html("立即购买");
        });
        $('#jiagouwu').click(function(){
            $('.show_box').show();
            $('#fade').show();
            var ba= $(this).parent();
            $("#gw_num").val(1);
            checkGood(ba);
            go=false;
            $(".btn_box1").html("加入购物车");
        });
    };
    H_login.closeLogin = function(){
        $('.close_box').click(function(){
            $('.show_box').hide();
            $('#fade').hide();
        });
        $('#fade').click(function(){
            $('.show_box').hide();
            $('#fade').hide();
        });
    };
    H_login.run = function () {
        this.closeLogin();
        this.openLogin();
    };
    H_login.run();
});
function checkGood(ba){//更新商品的购物车页面
    $(".select_btn").html("");
    var guige=ba.find(".guige_id").html();
    var guigeName=ba.find(".guige_name").html();
    var price=ba.find(".guige_price").html();
    var str='',str2='';
    guige=guige.split("|"); //字符分割
    guigeName=guigeName.split("|"); //字符分割
    price=price.split("|"); //字符分割
    for (i=0;i<guige.length ;i++ )
    {
        if(guigeName[i].length==0) continue;
        if(i==0){
            str='active';str2='checked';food_id=guige[i];
            $("#food_price").html("￥"+price[i]);
        }else {str='';str2='';}
        $(".select_btn").append('<div class="norm"> <label for="norm'+i+'" onclick="changeMoney('+price[i]+')" data-id="'+guige[i]+'"> <input type="radio" name="sex" '+str2+' value="'+guige[i]+'">'+guigeName[i]+' </label> <span class="btn '+str+'">'+guigeName[i]+'</span> </div>');
    }
    $(".select_btn label").on('click',function () {
        food_id=$(this).attr("data-id");
        $(this).siblings("span").addClass("active");
        $(this).parent().siblings("div").find("span").removeClass("active");
    });
}
function changeMoney(money) {
    $("#food_price").html("￥"+money);
}
function addCookie(id, num, price, name,text) {//添加商品，正常逻辑
    var has = false;
    var data = $.cookie('cart');
    if (data) {
        data = JSON.parse(data);
        for (var x = 0; x < 999; x++) {
            if (data.cart[x] == undefined)break;
            if (data.cart[x].id == id) {
                data.cart[x].num += parseInt(num);
                data.cart[x].text = text;
                has = true;
            }
        }
        data = JSON.stringify(data);
    }
    if (!has && data == null) {
        data = '{\"cart\":[{\"id\":' + id + ',\"num\":' + num + ',\"price\":' + price + ',\"name\":\"' + name + '\",\"text\":\"' + text + '\"}]}';
    } else {
        if (!has) {
            temp = ',{\"id\":' + id + ',\"num\":' + num + ',\"price\":' + price + ',\"name\":\"' + name + '\",\"text\":\"' + text + '\"}]}';  //从后面插入位移两位
            data = data.replace("]}", temp);
        }
    }
    $.cookie('cart', data, {expires: 1, path: '/'});
}
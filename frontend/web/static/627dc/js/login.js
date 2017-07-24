$(function () {
    H_login = {};
    H_login.openLogin = function(){
        $('.plus a').click(function(){
            $('.show_box').show();
            $('#fade').show();
           var ba= $(this).parent().parent();
           var img=ba.find(".lazy").attr("src");
           var name=ba.find(".food_name").html();
           var price=ba.find(".food_price").html();
            $("#food_img").attr("src",img);
            $("#food_name").html(name);
            $("#food_price").html(price);
            $("#gw_num").val(1);
            checkGood(ba);
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
        if(i==0){str='active';str2='checked';food_id=guige[i];}else {str='';str2='';}
        $(".select_btn").append('<div class="norm"> <label for="norm'+i+'" onclick="changeMoney('+price[i]+')" data-id="'+guige[i]+'"> <input type="radio" name="sex" '+str2+' value="'+guige[i]+'">'+guigeName[i]+' </label> <span class="btn '+str+'">'+guigeName[i]+'</span> </div>');
    }
    $(".select_btn label").on('click',function () {
        food_id=$(this).attr("data-id");
        $(this).siblings("span").addClass("active");
        $(this).parent().siblings("div").find("span").removeClass("active");
    });
}
function changeMoney(money) {
    $("#food_price").html("单价：￥"+money);
}
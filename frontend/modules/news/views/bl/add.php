<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>爆料系统</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/css/style.css" rel="stylesheet" type="text/css" />
    <script type='text/javascript' src='<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/localResizeIMG/js/jquery-2.0.3.min.js'></script>
    <script type='text/javascript' src='<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/localResizeIMG/js/LocalResizeIMG.js'></script>
    <script type='text/javascript' src='<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/localResizeIMG/js/patch/mobileBUGFix.mini.js'></script>
</head>

<body style=" background-color:#F4F5F6;">
<div class="box">
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/icon/return.png" width="30" height="30"></a></li>
            <p><a href="#">我要爆料</a></p>
            <div class="fdiv"><a href="javascript:void(0)" class="submit_btn">发布</a></div>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="blank"></div>
    <form id="bl_from" method="post" action="<?=\yii\helpers\Url::to(['addsave'])?>"  >
        <div class="mian">
        <div class="conten">
                <input type="text" id="title"  name="title"  class="w100" placeholder="请输入爆料主题">
                <textarea id="content"  name="content"  placeholder="请输入具体的爆料内容..."></textarea>
                <input type="hidden" name="img_num" id="img_num" value="0"/>
			   <input name="sub_rand" type="hidden" id="sub_rand" value="<?= rand(10000,100000000000);?>" />
        </div>
        <div class="_box" style="display:none">
            <input type="file" name="uploadfile"  accept="image/*" id="uploadphoto">选择照片
        </div>

        <div class="pictures">
            <a href="javascript:void(0);" onclick="uploadphoto.click()"><img src="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/images/j_img.png" width="30" height="30"></a>
        </div>
        <div class="Showimage">
            <ul id="imglist" class="clearfix">

            </ul>
        </div>


        <div class="margin_box"></div>
        <div class="touch_box">
            <ul>
                <img src="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/images/sj.png">
                <input type="text" id="phone"  name="phone"  placeholder="联系电话（选填，仅工作人员可见）">
            </ul>
        </div>
       <!--            <div class="place_box"><ul><img src="/bl_v1.0/images/dt.png">所在位置</ul></div>-->
    </div>
    </form>
</div>
</body>

<script type="text/javascript">
    var img_num=0;
    function cleImg(id){
        $('#img_'+id).val("");
        document.getElementById('showImg_'+id).style.display = "none";
    }
    $(document).ready(function(e) {
        $('#uploadphoto').localResizeIMG({
            width: 400,
            quality: 1,
            success: function (result) {
                var submitData={
                    base64_string:result.clearBase64,
                };
                var imgUrl = "data:image/jpg;base64," +  submitData.base64_string ;  // alert(submitData.base64_string);
                img_num++;
                $('#img_num').val(img_num);
                var attstr= '<li id="showImg_'+img_num+'"><img src="'+ imgUrl +'"/><a href="javascript:void(0);" id="col" onclick="cleImg('+img_num+')"><img src="<?=Yii::$app->view->theme->baseUrl?>/bl_v1.0/images/close.png"></a></li>';
                $("#imglist").append(attstr);
                $('#bl_from').append('<input type="hidden" name="img_'+img_num+'" id="img_'+img_num+'" value="'+result.base64+'"/>');



                //    $.ajax({
                //		   type: "POST",
                //		   url: "upload.php",
                //		   data: submitData,
                //		   dataType:"json",
                //		   success: function(data){
                //                if (0 == data.status) {
                //                     alert(data.content);
                //                     return false;
                //                 }else{
                //                    alert(data.content);
                //                    var attstr= '<img src="'+data.url+'">';
                //                    $(".imglist").append(attstr);
                //                    return false;
                //                }
                //            },
                //            complete :function(XMLHttpRequest, textStatus){
                //             },
                //            error:function(XMLHttpRequest, textStatus, errorThrown){ //上传失败
                //            alert(XMLHttpRequest.status);
                //            alert(XMLHttpRequest.readyState);
                //            alert(textStatus);
                //        }
                //    });

            }
        });
    });


    var checkSubmitFlg = 'first';
    $(".submit_btn").click(function() {
        if (checkSubmitFlg=='first') {
            title=$("#title").val();
            content = $('#content').val();
            phone=$("#phone").val();
            var reg=/(1[3-9]\d{9}$)/;
            if(title==''){
                alert('爆料主题不能为空!');
                return false;
            }else if(content == ""  ){
                alert('爆料内容不能为空!');
                return false;
            }else if(phone != ''&&!reg.test(phone)){
                alert('手机号码格式错误...');
            }else {
                document.getElementById("bl_from").submit();
                return checkSubmitFlg= 'two';// 第一次提交
            }
        } else {
            alert('请勿重复提交！');
            return checkSubmitFlg = 'two';
        }

    });


</script>


</html>

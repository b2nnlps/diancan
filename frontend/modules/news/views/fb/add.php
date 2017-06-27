<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-04-11
 * Time: 16:35
 */

?>
<!DOCTYPE html>
<html lang="en" class="html100">

<head>
    <meta charset="UTF-8">
    <title>爆料系统</title>
    <?= \yii\helpers\Html::csrfMetaTags()?>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <!-- 强制让文档的宽度与设备的宽度保持1:1，并且文档最大的宽度比例是1.0，且不允许用户点击屏幕放大浏览 -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width, minimal-ui">
    <!-- iphone设备中的safari私有meta标签，它表示：允许全屏模式浏览 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/css/bl_add.css">
    <link rel="stylesheet" href="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/bq/css/jquery.mCustomScrollbar.min.css" />
    <!--the css for this plugin-->
    <link rel="stylesheet" href="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/bq/css/jquery.emoji.css" />
</head>

<body>
<div class="box">
    <div class="Favorites">
        <div class="fdiv"><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/icon/return.png" width="30" height="30"></a></div>
        <div class="bdiv"><a href="#">我要爆料</a></div>
        <div class="fdiv"><a href="javascript:void(0)" class="submit_btn">发布</a></div>
        <div class="clear"></div>
    </div>
    <div class="blank"></div>
    <div class="publish-article-title">
        <input type="text" id="title" class="w100" placeholder="请输入爆料主题">
        <hr>
    </div>
    <div class="publish-article-content">
        <input type="hidden" id="target">
        <div class="article-content" id="content">
        </div>

        <div class="footer-btn g-image-upload-box">
            <div class="pull-left">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/images/ico.png" height="20" class="biaoqing" alt="">
            </div>
            <div class="pull-left upload-box">
                <span class="upload"><i class="upload-img"></i>插入图片</span>
                <input id="imageUpload" type="file" name="fileInput"  accept="image/*" style="position: absolute; left: 0; opacity: 0; width: 100%;top:0">
            </div>
            <div class="cl"></div>
        </div>
    </div>
    <div class="margin_box"></div>
    <div class="touch_box"><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/images/sj.png">
        <input type="text" id="phone" placeholder="联系电话（选填，仅工作人员可见）">
    </div>
    <div class="place_box"><img src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/images/dt.png">所在位置</div>

    <!--<div class="btn-check">
        <a href="javascript:void(0)" class="submit_btn">提交</a>
    </div>-->

</div>
<script src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/js/jquery-1.11.2.js"></script>
<script src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/js/layer/layer.js"></script>

<script src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/js/mobileEditor.js"></script>
<script src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/js/index.js"></script>
<script src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/bq/js/jquery.mousewheel-3.0.6.min.js"></script>
<script src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/bq/js/jquery.mCustomScrollbar.min.js"></script>
<script src="<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/bq/js/jquery.emoji.js"></script>

<script>
    function layer_msg(str){
        layer.msg('正在上传中',{shade:0.5});
    }
    function layer_close(){
        layer.closeAll();
    }
    $(function() {
        //设置content大小
        cont_h=$(window).height();
        top_title=$(".publish-article-title").height();
        cont_h=parseInt(cont_h)-parseInt(top_title)-220;

        $("#content").css({
            'height':cont_h
        })
        $('#content').artEditor({
            imgTar: '#imageUpload',
            limitSize: 6, // 兆
            showServer: true,
            //      uploadUrl: 'http://localhost/msjlb_v2.0/frontend/web/news/fb/fileupload',
      //       uploadUrl: '<?=\yii\helpers\Url::base(true)?>/fb_v1.0/server/server.php',
            uploadUrl: 'http://ms.n39.cn/fb_v1.0/server/server.php',
            data: {},
            uploadField: 'image',
            placeholader: '<p>请输入具体的爆料内容</p>',
            validHtml: ["<br/>"],
            formInputId: 'target',
            uploadSuccess: function(res) {
                // 这里是处理返回数据业务逻辑的地方
                // `res`为服务器返回`status==200`的`response`
                // 如果这里`return <path>`将会以`<img src='path'>`的形式插入到页面
                // 如果发现`res`不符合业务逻辑
                // 比如后台告诉你这张图片不对劲
                // 麻烦返回 `false`
                // 当然如果`showServer==false`
                // 无所谓咯
                var result = JSON.parse(res)
                if (result['code'] == '100') {
                    return result['data']['url'];
                } else {
                    switch (result['code']) {
                        case '101':{
                            alert('图片太大之类的')
                        }
                            break;
                        case '102':
                        {
                            alert('不支持这个文件')
                        }
                            break;
                        case '1024':
                        {
                            alert('不支持该文件类型')
                        }
                            break;
                    }
                }
                return false;
            },
            uploadError: function(status, error) {
                //这里做上传失败的操作
                //也就是http返回码非200的时候
                alert('网络异常' + status)
            }
        });
    });
    var csrfName = $('meta[name=csrf-param]').prop('content');
    var crsfToken = $('meta[name=csrf-token]').prop('content');
    var checkSubmitFlg = false;
    var reg=/(1[3-9]\d{9}$)/;
    $(".submit_btn").click(function() {
        title=$("#title").val();
        content = $('#content').getValue();
        phone=$("#phone").val();
        if(title=='') {
            alert('爆料主题不能为空!');
        }else if(content=='') {
            alert('爆料内容不能为空!');
        }else if(phone != ''&&!reg.test(phone)){
            alert('手机号码格式错误...');
        }else {
            if (!checkSubmitFlg) {
                var data = csrfName + '=' + crsfToken + "&title=" + title + "&content="+ content+ "&phone="+ phone;
//                alert(data);
                if (!checkSubmitFlg) {
                    checkSubmitFlg = true;// 第一次提交
                    $.post("<?=\yii\helpers\Url::to(['addsave'])?>", data, function (result) {
                        window.location.href = result;
                    });
                }
                return true;
            } else {
                alert('请勿重复提交！');
                return false;
            }

        }

    });
    $("#content").emoji({
        button: ".biaoqing",
        showTab: false,
        animation: 'slide',
        icons: [{
            name: "QQ表情",
            path: "<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/bq/img/qq/",
            maxNum: 91,
            excludeNums: [41, 45, 54],
            file: ".gif"
        }, {
            name: "贴吧",
            path: "<?=Yii::$app->view->theme->baseUrl?>/fb_v1.0/bq/img/tieba/",
            maxNum: 50,
            excludeNums: [41, 45, 54],
            file: ".jpg"
        }]
    });
</script>
</body>

</html>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/user.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/user_xz.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png" width="30" height="30"></a></li>
            <p>更新资料</p>
            <li id="save" style=" font-size:14px; color:#FE4543; display:none; ">保存</li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="data_box">
            <span>联&nbsp;系&nbsp;人</span>
            <em>阙君猛</em>
        </div>
        <div class="data_box">
            <span>手机号码</span>
            <em><input type="text" placeholder="输入您的手机号码"></em>
        </div>
        <div class="data_box">
            <span>验 证 码</span>
            <em> <input style="width:100px;" class="input_text input_text1 yzmdiv" type="search" name="name" id="verifycode" placeholder="短信验证码" />
                <input type="button" id="yzmdiv" value="获取验证码"/></em>
        </div>
        <div class="data_box">
            <span>会员等级</span>
            <em>
                <select>
                    <option>供应商</option>
                    <option>代理</option>
                    <option>会员</option>
                </select>
            </em>
        </div>
        <div class="data_box">
            <span>区&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;域</span>
            <em  class="dxdiv">
                <select>
                    <option>海南省</option>
                    <option>云南省</option>
                    <option>北京市</option>
                </select>
                <select>
                    <option>琼海市</option>
                    <option>昆明市</option>
                    <option>海淀区</option>
                </select>
                <select>
                    <option>博鳌镇</option>
                    <option>官渡区</option>
                    <option>三里屯</option>
                </select>
            </em>
        </div>
        <div class="data_box">
            <span>详细地址</span>
            <em><input type="text" placeholder="输入您的详细地址"></em>
        </div>
        <div class="data_box clearfix" id="bzdiv">
            <span>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</span>
            <em>
                <div class="opt" id="opt1">
                    <input class="magic-radio" type="radio" name="radio" id="r3" value="option3" checked>
                    <label for="r3">保密</label>
                </div>
                <div class="opt" id="opt1">
                    <input class="magic-radio" type="radio" name="radio" id="r1" value="option1">
                    <label for="r1">男</label>
                </div>
                <div class="opt" id="opt1">
                    <input class="magic-radio" type="radio" name="radio" id="r2" value="option2">
                    <label for="r2">女</label>
                </div>
            </em>
        </div>
        <div class="data_box clearfix" id="bzdiv">
            <span>兴趣爱好</span>
            <em>
                <div class="opt">
                    <input class="magic-checkbox" type="checkbox" name="layout" id="c1">
                    <label for="c1">跑步</label>
                </div>
                <div class="opt">
                    <input class="magic-checkbox" type="checkbox" name="layout" id="c2">
                    <label for="c2">听歌</label>
                </div>
                <div class="opt">
                    <input class="magic-checkbox" type="checkbox" name="layout" id="c3">
                    <label for="c3">玩游戏</label>
                </div>
                <div class="opt">
                    <input class="magic-checkbox" type="checkbox" name="layout" id="c4">
                    <label for="c4">旅游</label>
                </div>
            </em>
        </div>

        <div class="data_box clearfix" id="bzdiv">
            <span>个性签名</span>
            <em><textarea></textarea></em>
        </div>
    </div>
    <div class="refer1"><button type="submit" class="btn">提交</button></div>
</div>
</body>
</html>

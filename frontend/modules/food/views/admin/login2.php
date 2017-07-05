<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <link href="/static/627dc/css/login.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="logo"><img src="/static/627dc/icon/rh_logo.png"></div>
    <form id="login_form" method="post">
        <div class="input_div">
            <label><img src="/static/627dc/icon/user.png" width="30" height="30"></label>
            <input type="text" id="username" class="input_text" name="username" value="" placeholder="用户名" required="required">
        </div>
        <div class="input_div">
            <label><img src="/static/627dc/icon/password.png" width="30" height="30"></label>
            <input type="password" id="password" class="input_text" name="password" value="" placeholder="密码" required="required">
        </div>

        <!--<p class="error_err">*用户名或密码错误！</p>-->
       <input type="submit" name="loginBtn" id="loginBtn" class="btn" value="登录" />
    </form></div>
</body>
</html>


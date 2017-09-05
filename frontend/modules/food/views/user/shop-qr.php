<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>关注公众号后点餐</title>
    <link href="/static/95gx/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="code_box">
    <div class="code_content">
        <dl>
            <dt><img src="<?= $shop['img'] ?>"></dt>
            <dd>
                <p><?= $shop['name'] . ($table ? "($table)桌" : "") ?></p>
                <span><?= $shop['address'] ?></span>
            </dd>
            <div class="clear"></div>
        </dl>
        <div class="img">
            <img src="<?= $qrurl ?>">
            <p>长按关注后即可点餐</p>
        </div>
        <div class="p_box">
            <p>为了方便订单通知，请长按二维码识别关注公众号</p>
        </div>
    </div>
</div>

</body>
</html> 
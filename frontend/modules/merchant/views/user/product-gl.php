<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合商圈</title>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/css/shop.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box"><!--头部：开始--->
    <div class="Favorites">
        <ul>
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/return1.png"></a></li>
            <p>商品管理列表</p>
            <li><a href="#"></a></li>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="main">
        <div class="seek_box">
            <div class="seek clearfix">
                <input type="text" placeholder="请输入您查询的商品名称">
                <a href="#"><img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/ssimg.png"></a>
            </div>
        </div>
        <div class="gl_list_box">
            <div class="gl_list">

                <?php
                foreach ($agent as $_v){
                $product_id=$_v['product_id'];
                $product=\backend\modules\merchant\models\Product::findOne($product_id);
                $session=Yii::$app->session['fxsc_cart'];//获取session值
                $cart=\backend\modules\merchant\models\Cart::find()->where(['product_id'=>$_v['id'],'session_id'=>$session])->one();
                $number=$cart['number'];
                if ($number == null) {
                    $number = 0;
                }
                ?>
                <dl>
                    <dt><a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/good/commodity','aid'=>$_v['id']])?>">
                            <img src="<?=$product['thumb']?>" alt="<?=$product['name']?>">
                        </a>
                    </dt>
                    <dd>
                        <h3>
                            <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/good/commodity','aid'=>$_v['id']])?>"><?=$product['name']?></a>
                        </h3>
                        <span>已售：<?=$_v['sales']?><?=$product['sku']?></span>
                        <span>实库存:<em class="stock"><?=$_v['stock']?></em><?=$product['sku']?>&nbsp;&nbsp;&nbsp;&nbsp;虚库存:<em class="stock"><?=$_v['bookable']?></em><?=$product['sku']?></span>
                        <h5>￥<em class="price"><?=$_v['price']?>/<?=$product['sku']?></em></h5>
                    </dd>
                    <div class="clear"></div>
                    <div class="alterdiv">
                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/product-update','aid'=>$_v['id']])?>">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/merchant_v1.0/icon/bj.png"></a>
                    </div>
                </dl>
                <?php }?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
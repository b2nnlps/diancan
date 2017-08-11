<?php

namespace frontend\modules\food\controllers;

use Yii;
use yii\web\Controller;
use member\modules\food\models\Food;
use member\modules\food\models\FoodInfo;
use member\modules\food\models\Shop;
use member\modules\food\models\Order;
use member\modules\food\models\OrderInfo;
use frontend\controllers\BaseController;
use member\modules\food\models\ShopStaff;
use member\modules\food\models\User;
use member\modules\sys\models\WechatUser;

/**
 * Default controller for the `food` module
 */
class UserController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $enableCsrfValidation = false;
    public $layout = false;

    public function actionIndex($shopId = 0, $table = 0)
    {
        if ($shopId && isset($_COOKIE['shopId'])) if ($shopId != $_COOKIE['shopId']) setcookie('cart', '', time() - 1, '/');

        if ($shopId) setcookie("shopId", $shopId, time() + 86400 * 7, "/"); else $shopId = $_COOKIE['shopId'];
        if ($table) setcookie("table", $table, time() + 86400 * 7, "/");

        $shop = Shop::findOne($shopId);

        return $this->render('index', ['shopId' => $shopId, 'shop' => $shop]);
    }

    public function actionDebug()
    {
        var_dump($_COOKIE);

    }

    public function actionJIndex($shop = 1)
    {
        if ($shop) setcookie("shop", $shop, time() + 86400 * 7, "/");

        $u = User::findOne(['openid' => $this->openid]);
        $food = Food::getFoodList($shop);
        $shop = Shop::findOne($shop);
        return $this->render('jf_shop', ['food' => $food, 'shop' => $shop, 'u' => $u]);
    }

    public function actionDetail($id)
    {
        $food = Food::findOne($id);
        $shop = Shop::findOne($food['shop_id']);
        $stock = Food::getStock($id);
        $order = Order::getFoodOrder($id);
        $price = Food::getPrices($id);

        return $this->render('detail', ['food' => $food, 'price' => $price, 'shop' => $shop, 'order' => $order, 'stock' => $stock]);
    }

    public function actionJDetail($id)
    {
        $info = FoodInfo::findOne($id);
        $food = Food::findOne($info['food_id']);
        $shop = Shop::findOne($food['shop_id']);
        $stock = Food::getStock($info['food_id']);
        $order = Order::getFoodOrder($info['food_id']);//假装兑换的人很多
        $u = User::findOne(['openid' => $this->openid]);
        setcookie("shop", $food['shop_id'], time() + 86400 * 7, "/");
        return $this->render('jf_detail', ['food' => $food, 'shop' => $shop, 'u' => $u, 'stock' => $stock, 'info' => $info, 'order' => $order]);
    }

    public function actionJRecord()
    {//积分记录
        $record = Order::getJFoodOrder($this->openid, 0);
        return $this->render('jf_record', ['record' => $record]);
    }

    public function actionCart()
    {//购物车
        $cart = null;
        if (isset($_COOKIE['cart'])) {
            $cookie = $_COOKIE['cart'];
            $cookie = json_decode($cookie, true);
            $cart = $cookie['cart'];
        }

        $u = User::findOne($this->openid);
        return $this->render('cart', ['cart' => $cart, 'u' => $u]);
    }

    public function actionOrder()
    {//放cookie
        $cart = Food::getCart();
        if (!$cart) return self::actionIndex();
        if (!count($cart)) return self::actionIndex();

        $total_price = 0;
        $total_number = 0;
        $text = '';
        $foods = [];
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['num'] <= 0) continue;
            $info = FoodInfo::findOne($cart[$i]['id']);
            if ($info) {
                if (!isset($foods[$info['food_id']])) {//免去重复查询数据库
                    $foods[$info['food_id']] = Food::findOne($info['food_id']);
                }
                $food = $foods[$info['food_id']];
                $total_number += $cart[$i]['num'];
                $total_price += $info['price'] * $cart[$i]['num'];
                $name = (strlen($info['title']) > 0) ? $food['name'] . '-' . $info['title'] : $food['name'];
                $text .= '<dl class="clearfix"><dt>
<h5>' . $name . '</h5>
<span>' . $cart[$i]['text'] . '</span></dt><dd>
<span class="amount_box">X' . $cart[$i]['num'] . '</span>
<span class="price_box">￥' . $info['price'] * $cart[$i]['num'] . '</span></dd></dl>';
            }
        }

        $u = User::findOne($this->openid);
        return $this->render('order', ['text' => $text, 'total_price' => $total_price, 'total_number' => $total_number, 'u' => $u]);
    }

    public function actionPayOrder()
    {//生成订单并支付
        $cart = Food::getCart();

        if (count($cart) == 0) return '您未选购菜品';

        $request = Yii::$app->request;
        $total_price = 0;
        $text = '';
        $name = $request->post('name', ' ');
        $phone = $request->post('phone', ' ');
        $notic = $request->post('notic', ' ');
        $people = $request->post('people', 1);
        $table = $request->post('table', isset($_COOKIE['table']) ? $_COOKIE['table'] : '无');
        $_csrf = $request->post('_csrf', '');//防止重复提交
        $session = Yii::$app->session;
        if ($session->has('csrf') && $session['csrf'] == $_csrf)
            return $this->render('success-order', ['shop_id' => $_COOKIE['shopId'], 'o' => Order::findOne($session['order_id'])]);

        User::newUser($this->openid, $name, $phone, $notic);

        $staff = ShopStaff::findOne(['shop_id' => $_COOKIE['shopId'], 'openid' => $this->openid, 'status' => 0]);
        $order = Order::newOrder($this->openid, $_COOKIE['shopId'], '0', $name, $phone, $table, $people, $staff, $notic);

        $foods = [];
        $total = 0;
        for ($i = 0; $i < count($cart); $i++) {
            $info = FoodInfo::findOne($cart[$i]['id']);
            if ($info && $cart[$i]['num'] > 0) {
                if (!isset($foods[$info['food_id']])) {//免去重复查询数据库
                    $foods[$info['food_id']] = Food::findOne($info['food_id']);
                }
                $food = $foods[$info['food_id']];
                $total_price += $info['price'] * $cart[$i]['num'];
                $text .= $food['name'] . $info['title'] . '   x' . $cart[$i]['num'] . '  ￥' . $info['price'] * $cart[$i]['num'] / 100 . '<br>';
                $total += $info['price'] * $cart[$i]['num'];
                OrderInfo::newOrderInfo($order->id, $info['food_id'], $info['id'], $info['price'] * 100, $cart[$i]['num'], $cart[$i]['text']);
            }
        }
        $order->total = $total;
        $order->save();
        $session['csrf'] = $_csrf;//防止重复提交
        $session['id'] = $order['id'];//防止重复提交

        if ($staff) {
            setcookie('cart', '', time() - 1, '/');
            $s = "http://ms.n39.cn/food/default/push-mess?orderno=$order->id";
            $s = str_replace(" ", "", $s);
            $text2 = file_get_contents($s);

            return $this->render('shop-success', ['shop_id' => $order['shop_id']]);
        } else {
            header("Location: http://ms.n39.cn/wxpay/$order[shop_id]/n_food_pay.php?order_id=$order->id");
        }

        exit;
    }

    public function actionMyOrder()
    {
        Order::deleteAll('user=:openid AND status=0 AND created_time<=:time', [':openid' => $this->openid, ':time' => date("Y-m-d H:i:s", time() - 86400)]);
        //删除过期未支付订单
        $o = Order::find()->where(['user' => $this->openid])->orderBy("created_time desc")->all();
        return $this->render('my-order', ['o' => $o]);
    }

    public function actionOrderDetail($order_id)
    {
        $o = Order::findOne($order_id);
        $orderInfo = OrderInfo::getUserOrderInfo($this->openid, $order_id);
        return $this->render('order-detail', ['orderInfo' => $orderInfo, 'o' => $o]);
    }

    public function actionPaySuccess($order_id)
    {//支付完毕
        setcookie('cart', '', time() - 1, '/');
        $o = Order::findOne($order_id);
        return $this->render('success', ['o' => $o]);
    }

    public function actionPerson()
    {
        $u = WechatUser::findOne($this->openid);
        $staff = ShopStaff::findOne(['openid' => $this->openid, 'status' => 0]);

        return $this->render('person', ['u' => $u, 'staff' => $staff]);
    }

    public function actionShopInfo($shopId = 0)
    {//商家详情
        if ($shopId) setcookie("shopId", $shopId, time() + 86400 * 7, "/"); else $shopId = $_COOKIE['shopId'];
        $shop = Shop::findOne($shopId);
        $sold = Shop::getSold($shopId);//获取商家销量
        return $this->render('shop-detail', ['shop' => $shop, 'sold' => $sold]);
    }


}

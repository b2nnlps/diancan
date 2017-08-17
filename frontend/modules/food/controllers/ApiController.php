<?php

namespace frontend\modules\food\controllers;

use Yii;
use yii\web\Controller;
use member\modules\food\models\Food;
use member\modules\food\models\FoodInfo;
use member\modules\food\models\Classes;
use member\modules\food\models\Shop;
use member\modules\food\models\Order;
use member\modules\food\models\OrderInfo;
use member\modules\food\models\Feedback;
use common\wechat\JSSDK;

/**
 * Default controller for the `food` module
 */
class ApiController extends BaseApiController
{
    public function actionGetWaitOrder($status = false, $sort = "DESC")
    {//获取不同状态的菜品订单
        $this->isLogin();
        $order = Order::getWaitOrderInfo($this->shopId, $status, $sort);
        for ($i = 0; $i < count($order); $i++) {
            $order[$i]['food_name'] = Food::findOne($order[$i]['food_id'])['name'];
            $order[$i]['food_info'] = FoodInfo::findOne($order[$i]['info_id'])['title'];
        }
        return $this->response($order);
    }

    public function actionGetOrderList($status = 0)
    {//拉取订单
        $this->isLogin();
        $order = Order::find()->where(['shop_id' => $this->shopId, 'status' => $status])->limit(50)->asArray()->all();
        return $this->response($order);
    }

    public function actionGetOrderDetail($order_id)
    {//获取订单菜品的详情信息
        $this->isLogin();
        $return['order'] = Order::find()->where(['shop_id' => $this->shopId, 'id' => $order_id])->asArray()->one();//获取该订单信息
        $return['detail'] = OrderInfo::getOrderInfo($this->shopId, $order_id);//获取订单里的菜品信息
        return $this->response($return);
    }

    public function actionCheckOrder($info_id, $status)
    {//更新订单菜品状态
        $this->isLogin();
        $orderInfo = OrderInfo::findOne($info_id);
        $o = Order::findOne($orderInfo['order_id']);
        $return = false;
        if ($this->shopId == $o['shop_id'] && $orderInfo && $o) {
            $orderInfo->status = $status;
            $orderInfo->operator = $this->staff['realname'];
            $orderInfo->updated_time = date("Y-m-d H:i:s");
            $return = $orderInfo->save();
            $num = OrderInfo::find()->where('order_id=:order_id AND (status=0 or status=1)', [':order_id' => $orderInfo['order_id']])->count();
            if ($num == 0) {        //如果订单菜品已经出完
                $o['status'] = '2';
                $o->save(); //这里还可以加通知；
            }
        }

        return $this->response($return);
    }

    public function actionPrintOrder($order_id, $device_id)
    {//打印该订单信息
        $this->isLogin();
        $o = Order::findOne(['shop_id' => $this->shopId, 'id' => $order_id]);
        $return = Order::printOrder($o, $device_id);
        return $this->response($return);
    }

    public function actionUserInfo()
    {//获取店员信息
        $this->isLogin();
        $staff = $this->staff;
        $shop = Shop::find()->select(['name', 'img', 'description', 'contact', 'address', 'begin_time', 'end_time'])->where(['id' => $staff['shop_id']])->asArray()->one();
        $return['role_id'] = $staff['role_id'];
        $return['shop_id'] = $staff['shop_id'];
        $return['realname'] = $staff['realname'];
        $return['status'] = $staff['status'];
        $return['shop'] = $shop;
        return $this->response($return);
    }

    public function actionGetFoodList($shopId)
    {//获取菜品列表
        $shop = Shop::find()->select(['name', 'img', 'description', 'contact', 'address', 'begin_time', 'end_time'])->where(['id' => $shopId])->asArray()->one();
        $food = Food::find()->where('shop_id=:shop_id AND (status=0 OR status=1)', [':shop_id' => $shopId])->orderBy('sort ASC')->asArray()->all();
        $foodInfo = FoodInfo::find()->where(['shop_id' => $shopId, 'status' => 0])->orderBy('price ASC')->asArray()->all();
        $class = Classes::find()->where(['shop_id' => $shopId])->orderBy('sort ASC')->asArray()->all();
        $return['shop'] = $shop;
        $return['food'] = $food;
        $return['foodInfo'] = $foodInfo;
        $return['classes'] = $class;

        return $this->response($return);
    }

    public function actionFeedback($text)
    {//店员反馈
        $text = urldecode($text);
        $return = Feedback::newFeedback($this->staff['id'], $text, $this->shopId);
        return $this->response($return);
    }

    public function actionAdminFoodList()
    {//获取管理的商品列表
        $this->isLogin();
        $food = Food::find()->where('shop_id=:shop_id AND (status=0 OR status=1)', [':shop_id' => $this->shopId])->orderBy('sort ASC')->asArray()->all();
        $foodInfo = FoodInfo::find()->where(['shop_id' => $this->shopId, 'status' => 0])->orderBy('price ASC')->asArray()->all();
        $return['food'] = $food;
        $return['foodInfo'] = $foodInfo;
        return $this->response($return);
    }

    public function actionAdminFoodView($food_id)
    {//浏览商品的信息
        $this->isLogin();
        $food = Food::find()->where(['id' => $food_id, 'shop_id' => $this->shopId])->orderBy('sort ASC')->asArray()->one();
        $foodInfo = FoodInfo::find()->where(['food_id' => $food_id, 'shop_id' => $this->shopId, 'status' => 0])->orderBy('price ASC')->asArray()->all();
        $classes = Classes::find()->select(['id', 'name'])->where(['shop_id' => $this->shopId])->orderBy('sort ASC')->asArray()->all();
        $return['food'] = $food;
        $return['foodInfo'] = $foodInfo;
        $return['classes'] = $classes;
        return $this->response($return);
    }

    public function actionAdminFoodInfo($data)
    {
        $this->isLogin();
        $data = json_decode($data, true);
        $data_food = $data['food'];
        $data_info = $data['info'];


    }

}

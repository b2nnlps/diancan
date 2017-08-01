<?php

namespace frontend\modules\food\controllers;

use Yii;
use yii\web\Controller;
use member\modules\food\models\Food;
use member\modules\food\models\FoodInfo;
use member\modules\food\models\Shop;
use member\modules\food\models\Order;
use member\modules\food\models\OrderInfo;
use member\modules\food\models\ShopStaff;
use common\wechat\JSSDK;

/**
 * Default controller for the `food` module
 */
class ApiController extends BaseApiController
{
    public function actionGetOrder($status=false){
        $order=Order::getOrderInfo($this->shopId,$status);
        for($i=0;$i<count($order);$i++){
            $order[$i]['food_name']=Food::findOne($order[$i]['food_id'])['name'];
            $order[$i]['food_info']=FoodInfo::findOne($order[$i]['info_id'])['title'];
        }
        return $order;
    }
}

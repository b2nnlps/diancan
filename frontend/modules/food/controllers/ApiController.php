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
    public function actionGetOrder($status=false){//获取不同状态的菜品订单
        $this->isLogin();
        $order=Order::getOrderInfo($this->shopId,$status);
        for($i=0;$i<count($order);$i++){
            $order[$i]['food_name']=Food::findOne($order[$i]['food_id'])['name'];
            $order[$i]['food_info']=FoodInfo::findOne($order[$i]['info_id'])['title'];
        }
        return $this->response($order);
    }
    public function actionCheckOrder($info_id,$status){//更新订单菜品状态
        $this->isLogin();
        $orderInfo=OrderInfo::findOne($info_id);
        $o=Order::findOne($orderInfo['order_id']);
        $return=false;
        if($this->shopId==$o['shop_id']) {
            $orderInfo->status = $status;
            $return = $orderInfo->save();
            $num = OrderInfo::find()->where('order_id=:order_id AND (status=0 or status=1)', [':order_id' => $orderInfo['order_id']])->count();
            if ($num == 0) {        //如果订单菜品已经出完
                $o['status'] = '2';
                $o->save(); //这里还可以加通知；
            }
        }

        return $this->response($return);
    }
    public function actionUserInfo(){//获取店员信息
        $this->isLogin();
        $staff=$this->staff;
        $return['role_id']=$staff['role_id'];
        $return['shop_id']=$staff['shop_id'];
        $return['realname']=$staff['realname'];
        $return['status']=$staff['status'];
        return $this->response($return);
    }
}

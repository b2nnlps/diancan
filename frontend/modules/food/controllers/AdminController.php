<?php

namespace frontend\modules\food\controllers;

use Yii;
use yii\web\Controller;
use member\modules\food\models\Food;
use member\modules\food\models\Shop;
use member\modules\food\models\Order;
use member\modules\food\models\OrderInfo;
use member\modules\food\models\ShopStaff;
use frontend\controllers\BaseController;

/**
 * Default controller for the `food` module
 */
class AdminController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $layout=false;
    public $enableCsrfValidation = false; //莫名其妙不可以使用

    public function Power(){//返回当前绑定的饭店
        $staff=ShopStaff::findOne(['openid'=>$this->openid,'status'=>0]);
        if($staff) return $staff;
        return 0;
    }

    public function actionBind(){
        if(Yii::$app->request->isPost){
            $post=Yii::$app->request->post();
            $staff=ShopStaff::findOne(['username'=>$post['username'],'password'=>$post['password']]);
            if($staff){
                if($staff['openid']==''){
                    $staff['openid']=$this->openid;
                    $staff->save();
                    return '绑定成功，'.$staff['role_id'].' '.$staff['realname'];
                }else return '该账户已经绑定过微信';
            }
            return '未找到合适用户';
        }else
            return $this->render('login');
    }

    public function actionShopOrder($status=1){
        $staff=self::Power();
        if($staff && $staff['role_id']==0){
            $o=Order::find()->where(['shop_id'=>$staff['shop_id'],'status'=>$status])->orderBy("id desc")->all();
        }else{
            return 1;
        }
        return $this->render('shop-order',['o'=>$o,'status'=>$status]);
    }

    public function actionShopOrderJs($status=1,$v=""){
        $v.=1;
        $staff=self::Power();
        if($staff && $staff['role_id']==0){
            $o=Order::find()->where("shop_id=:shop_id AND status=:status AND id not in ($v)",['shop_id'=>$staff['shop_id'],'status'=>$status])->orderBy("id desc")->all();
        }else{
            return 1;
        }
        return $this->render('shop-order-js',['o'=>$o,'status'=>$status]);
    }
    public function actionShopOrderSuccess($o_id,$f_id){//单个菜品上菜成功
        $staff=self::Power();
        if($staff && $staff['role_id']==0){
            OrderInfo::updateAll(['status'=>1],['id'=>$f_id,'order_id'=>$o_id]);
            $num=OrderInfo::find()->where(['order_id'=>$o_id,'status'=>0])->count();
            if($num==0){        //如果订单菜品已经出完
                $o=Order::findOne($o_id);
                $o['status']='2';
                $o->save(); //这里还可以加通知；
            }

            return $num;
        }
        return 0;

    }

    public function actionAdmin(){
        $staff=self::Power();
        if($staff && $staff['role_id']==0){
            $food = (new \yii\db\Query())
                ->select(['a.id', 'a.name as fname','b.img','head_img','price','status','b.name as cname'])
                ->from('n_food_food a')
                ->rightJoin('n_food_classes b','a.class_id = b.id')
                ->where(['a.shop_id'=>$staff['shop_id']])
                ->orderBy('class_id')
                ->all();
            return $this->render('admin',['food'=>$food]);
        }
        return 0;
    }

    public function actionAdminPost(){
        $staff=self::Power();
        if($staff && $staff['role_id']==0){
            $get=Yii::$app->request->get();
            foreach($get as $k=>$v){
                $id=str_replace("f","",$k);
                $food=Food::findOne($id);
                if($food['shop_id']==$staff['shop_id']){
                    $food['status']=$v;
                    if($food->save())
                   echo $k."=>".$v."<br />";
                }
            }
        }
    }

}

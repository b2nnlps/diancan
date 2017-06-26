<?php

namespace backend\modules\eshop\controllers;

use backend\controllers\BaseController;
use Yii;
use backend\modules\eshop\models\Order;
use backend\modules\eshop\models\Orderproduct;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Default controller for the `eshop` module
 */
class StatController extends BaseController
{

	public function init()
	{
		$this->enableCsrfValidation = false;
	}
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex(){
        $this->layout = false; //不使用布局
        $user_id=Yii::$app->request->post('user_id');
        $product_id=Yii::$app->request->post('product_id');
        $start=Yii::$app->request->post('start');
        $end=Yii::$app->request->post('end');
		$status=Yii::$app->request->post('status');
		 
        //根据用户的查询条件拼装sql语句
        $where="1=1 and t_eshop_order.id=t_eshop_orderproduct.order_id and t_eshop_order.status <> 5 ";
        if($user_id!=""){
            $where.=" and t_eshop_order.user_id='$user_id'";
        }
        if($start!=""){
            if($end!=""){
                $where.=" and t_eshop_order.created_time>='$start' and t_eshop_order.created_time<='$end'";
            }else{
                $where.=" and t_eshop_order.created_time>='$start'";
            }
        }
        if($product_id!=""){
            $where.=" and t_eshop_orderproduct.product_id='$product_id'";
        }
		 if($status!=""){
            $where.=" and t_eshop_order.status='$status'";
        }
//        if(!empty($_GET['build_type'])){
//            $buildtype=$_GET['build_type'];
//            $where.=" and build_type LIKE '%$buildtype%'";
//        }


        $connection=Yii::$app->db;
       //  $sql="select  t_eshop_order.id,t_eshop_order.sn,t_eshop_order.referrer,t_eshop_order.user_id,t_eshop_order.phone,t_eshop_order.consignee,t_eshop_order.payment_method,t_eshop_order.payment_status,t_eshop_order.clearing,t_eshop_order.created_time,t_eshop_order.status,t_eshop_orderproduct.product_id,t_eshop_orderproduct.supplier_id,t_eshop_orderproduct.number,t_eshop_orderproduct.sku,t_eshop_orderproduct.amount,t_eshop_orderproduct.price from t_eshop_order,t_eshop_orderproduct  where ".$where." order by t_eshop_order.id DESC";
        //以下语句查询结果同上
       $sql="SELECT  t_eshop_order.id,t_eshop_order.sn,t_eshop_order.referrer,t_eshop_order.user_id,t_eshop_order.phone,t_eshop_order.consignee,t_eshop_order.payment_method,t_eshop_order.payment_status,t_eshop_order.clearing,t_eshop_order.created_time,t_eshop_order.status,t_eshop_orderproduct.product_id,t_eshop_orderproduct.supplier_id,t_eshop_orderproduct.number,t_eshop_orderproduct.sku,t_eshop_orderproduct.amount,t_eshop_orderproduct.price FROM t_eshop_order RIGHT JOIN t_eshop_orderproduct ON t_eshop_order.id=t_eshop_orderproduct.order_id  where ".$where."ORDER BY t_eshop_order.id desc";
       $command=$connection->createCommand($sql);
       $order=$command->queryAll();

        return $this->render('index',[
            'order'=>$order,
        ]);
	}
}

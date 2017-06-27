<?php

namespace frontend\modules\merchant\controllers;

use backend\modules\merchant\models\Address;
use backend\modules\merchant\models\Agent;
use backend\modules\merchant\models\Cart;
use backend\modules\merchant\models\Member;
use backend\modules\merchant\models\Order;
use backend\modules\merchant\models\Orderproduct;
use backend\modules\merchant\models\Orderstatus;
use backend\modules\merchant\models\Product;
use backend\modules\merchant\models\Supplier;
use common\wechat\PushMessage;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use frontend\controllers\BaseController;
/**
 * Default controller for the `merchant` module
 */
class OrderController extends BaseController
{
     /**
     * 购物车列表
     * @return string
     */
    public function actionCart($sid){
        $wx_openid=$this->wx_openid;//操作人
        if (($model =Member::find()->where(['wx_openid'=>$wx_openid])->one()) !== null) {
            $rh_openid=$this->rh_openid;//操作人
            $session=Yii::$app->session['fxsc_cart'];//获取session值
            //        $supplier_id= Yii::$app->request->get('sid');
            $cart=Cart::find()->where(['session_id'=>$session,'supplier_id'=>$sid])->asArray()->all();
            $address=Address::find()->where(['rh_openid'=>$rh_openid,'default'=>10])->asArray()->one();
            return $this->render('cart',[
                'cart'=>$cart,
                'address'=>$address,
                'supplier_id'=>$sid,
            ]);
        } else {
            return $this->redirect('../user/add');
        }
    }

    /**
     * 删除购物车
     */
    public function actionDeleteCart(){
        $id= Yii::$app->request->post('cartId');
        Cart::findOne($id)->delete();
    }


    /**
     * 保存订单
     * @return mixed
     */
    public function actionSaveOrder(){
        $session=Yii::$app->session['fxsc_cart'];//获取session值
        $rh_openid=$this->rh_openid;//操作人
        $wx_openid=$this->wx_openid;
        $request = Yii::$app->request;
        
        $address_id=$request->post('address_id');
 //       $method= $request->post('method');
        $supplier_id= $request->post('supplier_id');
		$thtime= $request->post('thtime');
        $remark= $request->post('remark');

        if($address_id){
            $address=Address::findOne($address_id);
            $order=new Order();
            $order->sn= date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
            $order->rh_openid=$rh_openid;

            $member=Member::find()->where(['rh_openid'=>$rh_openid])->one();
            $referrer=$member['referrer'];
            $order->referrer=$referrer;//推介人
            $order->consignee=$address['consignee'];
            $order->supplier_id=$supplier_id;
            $order->phone=$address['phone'];
            $order->zipcode=$address['zipcode'];
            $order->address=$address['address'];
			$order->receive_time=$thtime;
			
            $products = Cart::find()->where(['session_id' =>$session,'supplier_id'=>$supplier_id])->all();
            if (count($products)) {
                foreach($products as $product) {
                    $agentProduct=$product['product_id'];
                    $agent=Agent::findOne($agentProduct);
                    $price=$agent['price'];
                    $order->amount += $product->number * $price;
                }
            } else {
                $this->redirect(['merchant/good/product-list','sid'=>$supplier_id]);
            }
            $order->payment_method=1;
            $order->payment_status=1;
            $order->status=1;
            $order->remark=$remark;
            if ($order->save()) {
                // insert order_product and clear cart
                $orderId= $order->id;
                foreach ($products as $product) {
                    $agentProduct=$product['product_id'];
                    $agent=Agent::findOne($agentProduct);
                    $price=$agent['price'];

                    $productNumber=$product['number'];

                    $orderProduct = new Orderproduct();
                    $orderProduct->order_id = $orderId;
                    $orderProduct->supplier_id =$supplier_id;
                    $orderProduct->product_id = $agentProduct;
                    $orderProduct->rh_openid = $rh_openid;
                    $orderProduct->sku =$product['sku'];
                    $orderProduct->name =$product['name'];
                    $orderProduct->number = $productNumber;
                    $orderProduct->price = $price;
                    $orderProduct->status = 10;
                    $orderProduct->amount =$productNumber*$price;
                    $orderProduct->time =date("Y-m-d H:i:s");
                    $orderProduct->save();

                    //如果是代理商 则将代理商品绑定
                    $supplier=Supplier::find()->where(['rh_openid'=>$rh_openid])->one();
                    if(!empty($supplier)){
                        if($supplier['rank']==2){
                            $supplierID=$supplier['id'];
                            $product_id=$agent['product_id'];//产品ID
                            $market_price=$agent['market_price'];
                            $agentSp=Agent::find()->where(['rh_openid'=>$rh_openid,'product_id'=>$product_id])->one();
                            if(empty($agentSp)){
                                $agentSp=new Agent();
                                $agentSp->rh_openid=$rh_openid;
                                $agentSp->supplier_id=$supplierID;
                                $agentSp->product_id=$product_id;
                                $agentSp->stock=$productNumber;
                                $agentSp->bookable=$productNumber;
								$agentSp->status=1;
                            } else{
                                $agentSp->stock=$agentSp->stock+$productNumber;
                                $agentSp->bookable=$agentSp->bookable+$productNumber;
                            }
                            $agentSp->market_price=$market_price;
                            $agentSp->price=$price;
                            $agentSp->save();
                        }
                    }


                }
                //生成订单状态
                $orderStatus=new Orderstatus();
                $orderStatus->rh_openid=$rh_openid;
                $orderStatus->order_id=$orderId;
                $orderStatus->status=1;
                $orderStatus->remark='订单提交成功，待商家接单';
                $orderStatus->time =date("Y-m-d H:i:s");
                $orderStatus->save();

                // 生成订单后，清空购物车，
                Cart::deleteAll(['session_id' =>$session,'supplier_id'=>$supplier_id]);
                $sn= $order->sn;
                $phone=$order->phone;
                $payment_method=$order->payment_method;
                $total_price=$order->amount;


                $gourl=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/order-xq','order_id'=>$orderId]);
                $method=Order::method($payment_method);

                $first="订单提交成功！";
                $remark="点击左下角“详情”可查看更多！！";
                $openId=$wx_openid.",oV1VUt6RUheAI-xfveukXdNW2ak8";
                $mess_push=explode(',',$openId);
                $mess=array_unique($mess_push);
                //array_unique() 函数移除数组中的重复的值，并返回结果数组。当几个数组元素的值相等时，只保留第一个元素，其他的元素被删除。返回的数组中键名不变。
                for($i=0;$i<count($mess);$i++){
                    if(isset($mess[$i])){
                        if($mess[$i]!=''){
                            PushMessage::NeworderMessage($mess[$i],$first,$gourl,$sn,$method,$phone,$total_price.'元',$remark);
                        }
                    }
                }

                $supplier_wx=Supplier::findOne($supplier_id);
                $message=$supplier_wx['message'];
                if($message!=''){
                    $first1="系统收到了一条新的订单。";
                    $remark1="请相关人员核对该订单情况！！";
                    $openId1=$message.",oV1VUt6RUheAI-xfveukXdNW2ak8";
                    $mess_push1=explode(',',$openId1);
                    $mess1=array_unique($mess_push1);
                    //array_unique() 函数移除数组中的重复的值，并返回结果数组。当几个数组元素的值相等时，只保留第一个元素，其他的元素被删除。返回的数组中键名不变。
                    for($i1=0;$i1<count($mess1);$i1++){
                        if(isset($mess1[$i1])){
                            if($mess1[$i1]!=''){
                                PushMessage::NeworderMessage($mess1[$i1],$first1,$gourl,$sn,$method,$phone,$total_price.'元',$remark1);
                            }
                        }
                    }
                }

                return $strResult=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/order-detail','order_id'=>$orderId,'supplier_id'=>$supplier_id]);
            }
        }

    }

     /**
     * 微店订单列表
     * @return string
     */
    public function actionIndex(){
        $rh_openid=$this->rh_openid;
        $supplier=Supplier::find()->where(['rh_openid'=>$rh_openid])->one();
        if(!empty($supplier)){
            $supplierID=$supplier['id'];
            $connection=Yii::$app->db;
              $sql="select * from t_merchant_order where (payment_status=1 or shipment_status=1) and supplier_id=$supplierID order by id desc";
            $command=$connection->createCommand($sql);
            $order=$command->queryAll();
            return $this->render('index',[
                'order'=>$order,
                'rh_openid'=>$rh_openid,
                'supplierID'=>$supplierID,
            ]);
        }else{
            throw new NotFoundHttpException('所请求信息不存在！');
        }

    }
    /**
     * 我的订单列表
     * @return string
     */
    public function actionOrderList(){
        $rh_openid=$this->rh_openid;
        $connection=Yii::$app->db;
        $sql="select * from t_merchant_order where (payment_status=1 or shipment_status=1) and rh_openid='$rh_openid' order by id desc";
        $command=$connection->createCommand($sql);
        $order=$command->queryAll();
        return $this->render('order-list',[
            'order'=>$order,
            'rh_openid'=>$rh_openid,
        ]);
        
    }

    /**
     * 订单详情
     * @param $order_id
     * @return string
     */
    public function actionOrderDetail(){
        $request = Yii::$app->request;
        $rh_openid=$this->rh_openid;//操作人
        $wx_openid=$this->wx_openid;//操作人微信OpenID
        $order_id= $request->get('order_id');
        if(isset($_GET["supplier_id"]))//判断所需要的参数是否存在，isset用来检测变量是否设置，返回true or false
        {
            $supplier_id= $request->get('supplier_id');
        }else{
            $op=Order::findOne($order_id);
            $supplier_id=$op['supplier_id'];
        }

        $order=Order::findOne($order_id);
        if(!empty($order)){
            $supplier=Supplier::findOne($supplier_id);
            $message=$supplier['message'];//商家管理员

            $openId="oV1VUt6RUheAI-xfveukXdNW2ak8,".$message;

            $mess_push=explode(',',$openId);
            $mess=array_unique($mess_push);

            //in_array(value,array,type)
            $isin = in_array($wx_openid,$mess);//php判断数组元素中是否存在某个字符串的方法
            if($isin){
                $inArray=1;//存在
            }else{
                $inArray=10;//不存在
            }
            $orderStatus=Orderstatus::find()->where(['order_id'=>$order_id])->asArray()->orderBy('id desc')->all();
            $orderproduct=Orderproduct::find()->where(['order_id'=>$order_id])->asArray()->all();
            $supplier=Supplier::findOne($supplier_id);
            return $this->render('order-detail',[
                'orderStatus'=>$orderStatus,
                'order'=>$order,
                'orderproduct'=>$orderproduct,
                'supplier_id'=>$supplier_id,
                'supplier'=>$supplier,
                'inArray'=>$inArray,
            ]);
        }else{
            throw new NotFoundHttpException('所请求信息不存在，或已被删除！');
        }

    }
	
	  /**
     * 订单详情
     * @param $order_id
     * @return string
     */
    public function actionOrderXq(){
        $request = Yii::$app->request;
        $rh_openid=$this->rh_openid;//操作人
        $wx_openid=$this->wx_openid;//操作人微信OpenID
        $order_id= $request->get('order_id');
        if(isset($_GET["supplier_id"]))//判断所需要的参数是否存在，isset用来检测变量是否设置，返回true or false
        {
            $supplier_id= $request->get('supplier_id');
        }else{
            $op=Order::findOne($order_id);
            $supplier_id=$op['supplier_id'];
        }

        $order=Order::findOne($order_id);
        if(!empty($order)){
            $supplier=Supplier::findOne($supplier_id);
            $message=$supplier['message'];//商家管理员

            $openId="oV1VUt6RUheAI-xfveukXdNW2ak8,".$message;

            $mess_push=explode(',',$openId);
            $mess=array_unique($mess_push);

            //in_array(value,array,type)
            $isin = in_array($wx_openid,$mess);//php判断数组元素中是否存在某个字符串的方法
            if($isin){
                $inArray=1;//存在
            }else{
                $inArray=10;//不存在
            }
            $orderStatus=Orderstatus::find()->where(['order_id'=>$order_id])->asArray()->orderBy('id desc')->all();
            $orderproduct=Orderproduct::find()->where(['order_id'=>$order_id])->asArray()->all();
            $supplier=Supplier::findOne($supplier_id);
            return $this->render('order-xq',[
                'orderStatus'=>$orderStatus,
                'order'=>$order,
                'orderproduct'=>$orderproduct,
                'supplier_id'=>$supplier_id,
                'supplier'=>$supplier,
                'inArray'=>$inArray,
            ]);
        }else{
            throw new NotFoundHttpException('所请求信息不存在，或已被删除！');
        }

    }
    /**
     * 订单状态
     * @return mixed
     */
    public function actionOrderStatus(){
        $request = Yii::$app->request;
        $rh_openid=$this->rh_openid;//操作人
        $wx_openid=$this->wx_openid;//操作人微信OpenID

        $orderid =$request->post('orderid');
        $remark = $request->post('remark');
        $supplier_id =$request->post('supplier_id');
        $payment_status=$request->post('payment_status');
        $shipment_status = $request->post('shipment_status');
        if ($orderid ) {
            $order=Order::findOne($orderid);
            $order->status=1;
            $order->operator=$rh_openid;
            if($payment_status!=3){
                $order->payment_status=$payment_status;
            }
            if($shipment_status!=3){
                $order->shipment_status=$shipment_status;
            }

            $sn=$order->sn;
            $order_user=$order->rh_openid;
//            $referrer=$order->referrer;
            if($order->save()) {

                $orderStatus = new Orderstatus();
                $orderStatus->rh_openid = $rh_openid;
                $orderStatus->order_id = $orderid;
                  if ($payment_status == 2 && $shipment_status == 2) {
                    $stu=4;
                    $orderStatus->status = $stu;
                } else {
                    if ($payment_status == 2) {
                        $stu=2;
                        $orderStatus->status = $stu;
                    } elseif ($shipment_status == 2) {
                        $stu=3;
                        $orderStatus->status = $stu;
                    }
                }

                $orderStatus->remark = $remark;
                $orderStatus->time = date("Y-m-d H:i:s");
                $orderStatus->save();

                $order_product = Orderproduct::find()->where(['order_id' => $orderid])->all();
                foreach ($order_product as $_v) {
                    $product_id = $_v['product_id'];
                    $number = $_v['number'];

//                    if($orderstatus==2){//当确定接单时，商品同步减少可预订库存和增加销量
//                        Agent::updateAllCounters(['bookable' => -$number,'sales' => +$number], ['id' => $product_id]);
//                    }elseif ($orderstatus==3){///当订单已配送时，商品同步减少真实库存和增加销量
//                        Agent::updateAllCounters(['stock' => -$number], ['id' => $product_id]);
//                    }elseif($orderstatus==5){//当已接单时，取消订单同步增加可预订库存和减销量
//                        Agent::updateAllCounters(['bookable' => +$number,'sales' => -$number], ['id' => $product_id]);
//                    }elseif ($orderstatus==6){///当订单已配送时，取消订单同步增加可预订库存和真实库存，减销量
//                        Agent::updateAllCounters(['bookable' => +$number,'stock' => +$number,'sales' => -$number], ['id' => $product_id]);
//                    }


                    if (($payment_status == 1 && $shipment_status == 2)) {//未付款已取货：真实库存和虚拟库存同时减去相应数量
                        Agent::updateAllCounters(['bookable' => -$number, 'stock' => -$number, 'sales' => +$number], ['id' => $product_id]);
                    } elseif ($payment_status == 2 && $shipment_status == 1) {///已付款未取货：真实库存不变，虚拟库存减去相应数量；
                        Agent::updateAllCounters(['bookable' => -$number], ['id' => $product_id]);
                    } elseif ($payment_status == 2 && $shipment_status == 2) {//已付款已取货：真实库存和虚拟库存同时减去相应数量；
                        Agent::updateAllCounters(['bookable' => -$number, 'stock' => -$number, 'sales' => +$number], ['id' => $product_id]);
                    } elseif ($payment_status == 3 && $shipment_status == 2) {//已取货：真实库存减去相应数量；
                        Agent::updateAllCounters(['stock' => -$number, 'sales' => +$number], ['id' => $product_id]);
                    }

                }

                $supplier=Supplier::findOne($supplier_id);
                $message=$supplier['message'];
                $member=Member::find()->where(['rh_openid'=>$order_user])->one();
                $xdwx_openid=$member['wx_openid'];
                $openId=$xdwx_openid.','.$wx_openid.',oV1VUt6RUheAI-xfveukXdNW2ak8,'.$message;
                $mess_push=explode(',',$openId);
                $mess=array_unique($mess_push);

                $first='您好！您有一条订单状态更新！';
                $gourl=Yii::$app->urlManager->createAbsoluteUrl(['merchant/order/order-xq','order_id'=>$orderid]);
                $status=Orderstatus::status($stu);
                $remarks='【备注：'.$remark.'】点击“详情”查看完整订单信息！';
                for($i=0;$i<count($mess);$i++){
                    if(isset($mess[$i])){
                        if($mess[$i]!=''){
                           PushMessage::OrderupdateMessage($mess[$i],$first,$gourl,$sn,$status,$remarks);
                        }}
                }

                return $strResult ='';

            }
        }
    }

    protected function findAgent($id){
        if (($model =Agent::findOne($id)) !== null) {
            Agent::updateAllCounters(['pv' => 1], ['id' => $id]);//浏览次数加1
            return $model;
        } else {
            throw new NotFoundHttpException('所请求信息不存在！');
        }
    }
    protected function findProduct($id){
        if (($model =Product::findOne($id)) !== null) {
            Product::updateAllCounters(['pv' => 1], ['id' => $id]);//浏览次数加1
            return $model;
        } else {
            throw new NotFoundHttpException('所请求信息不存在！');
        }
    }
}

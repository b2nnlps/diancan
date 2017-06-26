<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-25
 * Time: 17:03
 */

namespace frontend\modules\eshop\controllers;

use Yii;
use backend\modules\eshop\models\Cart;
use backend\modules\eshop\models\Order;
use backend\modules\eshop\models\Orderproduct;
use backend\modules\eshop\models\Orderstatus;
use backend\modules\sys\models\Address;
use backend\modules\eshop\models\Product;
use yii\web\Controller;
use common\wechat\PushMessage;
use backend\modules\eshop\models\Sumpplier;
use backend\modules\sys\models\Member;
use frontend\controllers\BaseController;
//class OrderController extends Controller
class OrderController extends BaseController
{
    /**
     * 添加购物车
     * @return string
     */
    public function actionAddCart(){
       Yii::$app->session['step'] = 1;
        $session=  Yii::$app->session->id ;
        $productId = Yii::$app->request->post('productid');
        $number = Yii::$app->request->post('number');//$_POST['number']
		 $user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        if ($productId) {
            $model = Product::findOne($productId);
            $pattern=$model->pattern;//营销模式
            // 如果购物车已有，则更新，否则在购物车中增加
            if ($cart = Cart::find()->where(['and', 'product_id='.$productId, ['or', 'session_id="' . $session . '"', 'user_id=' .'' ? 0 : $user_id]])->one()) {
                $product = Product::findOne($productId);
                $stock=$product->stock;//库存
                if ($number<=$stock&&$number!=0) {
                    $cart->number=$number;

//                    if($pattern==2){//分额度模式
//                        $prdtinfo=Prdtinfo::findOne($productId);
//                        $limit1=$prdtinfo['limit1'];
//                        $limit2=$prdtinfo['limit2'];
//                        $limit3=$prdtinfo['limit3'];
//                        if($number<$limit1){
//                            $cart->price = $prdtinfo->price1;
//                        } elseif($limit1<$number&&$number<$limit2){
//                            $cart->price = $prdtinfo->price2;
//                        }elseif($limit2<$number&&$number<$limit3){
//                            $cart->price = $prdtinfo->price3;
//                        }
//                    }else{
                    $cart->price = $model->price;
//                    }
                    $cart->save();
//                    $cart->updateAllCounters(['number' => $number], ['and', 'product_id=' . $productId, ['or','session_id="' . $session . '"', 'user_id=' . ''? 0 : $user_id]]);
//                    return $strResult='下单成功！';
//                    return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['eshop/index/cart']));
                }elseif ($number>$stock){
                    $cart->number=$stock;
                    $cart->save();
                }elseif ($number==0){
                    $cart->delete();
                } else {
                    return $strResult='下单失败3！';
                }
            } elseif ($model) {
                if ($model->stock >= $number) {
                    $cart = new Cart();
                    $cart->session_id =$session;
                    $cart->user_id = ''? 0 : $user_id;
                    $cart->supplier_id = $model->supplier_id;
                    $cart->product_id = $productId;
                    $cart->number = $number;
                    $cart->sku = $model->sku;
                    $cart->name = $model->name;
//                    if($pattern==2){//分额度模式
//                        $prdtinfo=Prdtinfo::findOne($productId);
//                        $limit1=$prdtinfo['limit1'];
//                        $limit2=$prdtinfo['limit2'];
//                        $limit3=$prdtinfo['limit3'];
//                        if($number<$limit1){
//                            $cart->price = $prdtinfo->price1;
//                        } elseif($limit1<$number&&$number<$limit2){
//                            $cart->price = $prdtinfo->price2;
//                        }elseif($limit2<$number&&$number<$limit3){
//                            $cart->price = $prdtinfo->price3;
//                        }
//                    }else{
                    $cart->price = $model->price;
//                    }
                    $cart->status =1;
                    $cart->save();
//                    return $strResult='下单成功！';
//                    return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['eshop/index/cart']));
                } else {
                    return $strResult='下单失败2！';
                }
            }
        }else {
            return $strResult='下单失败1！';
        }

    }

    /**
     * 购物车列表
     * @return string
     */
    public function actionCart(){
        Yii::$app->session['step'] = 1;
        $session=Yii::$app->session->id;
		 $user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $supplier_id= Yii::$app->request->get('supplier_id');
        $cart=Cart::find()->where(['session_id'=>$session,'supplier_id'=>$supplier_id])->asArray()->all();
        $address=Address::find()->where(['user_id'=>$user_id,'default'=>10])->asArray()->one();
        return $this->render('cart',[
            'cart'=>$cart,
            'address'=>$address,
            'supplier_id'=>$supplier_id,
        ]);
    }

    /**
     * 删除购物车
     */
    public function actionDeleteCart(){
        $id= Yii::$app->request->post('productId');
        Cart::findOne($id)->delete();
    }

    /**
     * 保存订单
     * @return mixed
     */
    public function actionSaveOrder(){
        Yii::$app->session['step'] = 1;
        $session=  Yii::$app->session->id ;
		 $user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $address_id= Yii::$app->request->post('address_id');
        $method= Yii::$app->request->post('method');
        $supplier_id= Yii::$app->request->post('supplier_id');
        $remark= Yii::$app->request->post('remark');
        if($address_id&&$method){
            $address=Address::findOne($address_id);
            $order=new Order();
            $order->sn=date('YmdHis').rand(1000, 9999);;
            $order->user_id=$user_id;
			
            $member=Member::findOne($user_id);
            $referrer=$member['referrer'];
            $order->referrer=$referrer;//推介人
			
            $order->consignee=$address['consignee'];
            $order->phone=$address['phone'];
            $order->zipcode=$address['zipcode'];
            $order->address=$address['address'];
            $products = Cart::find()->where(['session_id' =>$session,'supplier_id'=>$supplier_id])->all();
            if (count($products)) {
                foreach($products as $product) {
                    $order->amount += $product->number * $product->price;
                }
            } else {
                $this->redirect('eshop/good/product-list');
            }
            $order->payment_method=1;
            $order->payment_status=1;
            $order->status=1;
            $order->remark=$remark;
            if ($order->save()) {
                // insert order_product and clear cart
                $orderId= $order->id;
                foreach ($products as $product) {
                    $productId= $product->product_id;
                    $orderNumber=$product->number;
                    $orderPrice=$product->price;
						
                    $orderProduct = new Orderproduct();
                    $orderProduct->order_id = $orderId;
                    $orderProduct->supplier_id =$product->supplier_id;
                    $orderProduct->product_id = $productId;
                    $orderProduct->user_id = $user_id;
                    $orderProduct->sku = $product->sku;
                    $orderProduct->name = $product->name;
                    $orderProduct->number = $orderNumber;
                    $orderProduct->price = $orderPrice;
                    $orderProduct->status = 10;
                    $orderProduct->amount =$orderNumber*$orderPrice;
                    $orderProduct->save();
                    // 商品的库存
                    Product::updateAllCounters(['stock' => -$orderNumber,'sales' => +$orderNumber], ['id' => $productId]);

                }
                //生成订单状态
                $orderStatus=new Orderstatus();
                $orderStatus->user_id=$user_id;
                $orderStatus->order_id=$orderId;
//                $orderStatus->product_id=$productId;
                $orderStatus->status=1;
                $orderStatus->remark='订单提交成功，待商家接单';
                $orderStatus->created_by=$user_id;
                $orderStatus->save();

                // 生成订单后，清空购物车，
                Cart::deleteAll(['session_id' =>$session]);
				$sn= $order->sn;
                $phone=$order->phone;
                $payment_method=$order->payment_method;
                $total_price=$order->amount;
    
				getOrderMss($user_id,$orderId,$sn,$payment_method,$phone,$total_price,$referrer,$supplier_id);
                return $strResult=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/order-detail','order_id'=>$orderId,'supplier_id'=>$supplier_id]);
            }
        }

    }

    /**
     * 订单列表
     * @return string
     */
    public function actionIndex(){
         $user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $order=Order::find()->where(['user_id'=>$user_id])->asArray()->orderBy('id desc')->all();
        return $this->render('index',[
            'order'=>$order,
        ]);
    }
  /**
     * 所有订单列表
     * @return string
     */
    public function actionOrderList(){
         $user_id=$this->openid;
        // $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $member=Member::findOne($user_id);
        $rank=$member->rank;
        if($rank!=1){
            return $this->render('order-list',[
				'user_id'=>$user_id,
			]);
        }
    }
	    /**
     * 所有结算订单列表
     * @return string
     */
    public function actionClearingList(){
		 $user_id=$this->openid;
        //   $user_id= 'oV1VUt0U0HE0F5T3sCry_LGaFuSA';
        //$user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $member=Member::findOne($user_id);
        $rank=$member->rank;
        if($rank!=1){
            return $this->render('clearing-list',[
                'user_id'=>$user_id,
            ]);
        }
    }
      /**
     * 订单详情
     * @param $order_id
     * @return string
     */
    public function actionOrderDetail(){
          $user_id=$this->openid;
       //   $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
	    $order_id= Yii::$app->request->get('order_id');
        if(isset($_GET["supplier_id"]))//判断所需要的参数是否存在，isset用来检测变量是否设置，返回true or false 
        {
            $supplier_id= Yii::$app->request->get('supplier_id');
        }else{
            $op=Orderproduct::find()->where(['order_id'=>$order_id])->one();
            $supplier_id=$op['supplier_id'];
        }
	 
        $order=Order::findOne($order_id);
         if(!empty($order)){
            $referrer=$order['referrer'];//推荐人
            $supplier=Sumpplier::findOne($supplier_id);
            $message=$supplier['message'];//商家管理员
            if($message!='') {
                $opid = $message;
                if ($referrer != '0') {
                    $opid .= ',' . $referrer;
                }
            }else{
                $opid ='';
            }
            $openId=$opid.",oV1VUt6RUheAI-xfveukXdNW2ak8";

            $mess_push=explode(',',$openId);
            $mess=array_unique($mess_push);

            //in_array(value,array,type)
            $isin = in_array($user_id,$mess);//php判断数组元素中是否存在某个字符串的方法
            if($isin){
                $inArray=1;//存在
            }else{
                $inArray=10;//不存在
            }
            $orderStatus=Orderstatus::find()->where(['order_id'=>$order_id])->asArray()->orderBy('id desc')->all();
            $orderproduct=Orderproduct::find()->where(['order_id'=>$order_id])->asArray()->all();
            return $this->render('order-detail',[
                'orderStatus'=>$orderStatus,
                'order'=>$order,
                'orderproduct'=>$orderproduct,
                'supplier_id'=>$supplier_id,
                'inArray'=>$inArray,
            ]);
        }else{
            echo '该订单已删除！';
        }
    }

    /**
     * 订单状态
     * @return mixed
     */
    public function actionOrderStatus(){
		 $user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $orderid = Yii::$app->request->post('orderid');
        $orderstatus = Yii::$app->request->post('orderstatus');
        $remark = Yii::$app->request->post('remark');
		$supplier_id = Yii::$app->request->post('supplier_id');
        if ($orderid && $orderstatus) {
            $order=Order::findOne($orderid);
            $order->status=$orderstatus;
			 $sn=$order->sn;
			$order_user=$order->user_id;
            $referrer=$order->referrer;
            if($order->save()){
                $orderStatus=new Orderstatus();
                $orderStatus->user_id=$user_id;
                $orderStatus->order_id=$orderid;
                $orderStatus->created_by=$user_id;
                $orderStatus->updated_by=$user_id;
                $orderStatus->status=$orderstatus;
                $orderStatus->remark=$remark;
                $orderStatus->save();
				if($orderstatus==5){//如果取消订单
                    $order_product=Orderproduct::find()->where(['order_id'=>$orderid])->all();
                    foreach ($order_product as $_v){
                        $product_id=$_v['product_id'];
                        $number=$_v['number'];
                        // 商品的库存
                        Product::updateAllCounters(['stock' => +$number,'sales' => -$number], ['id' => $product_id]);
						
                    }
                }
				  getOrderupdate($user_id,$orderid,$sn,$orderstatus,$remark,$supplier_id,$order_user,$referrer);
                return $strResult=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/order-detail','order_id'=>$orderid]);
            }
        }
    }

}


/**
 * 订单模板
 * @param $user_id
 * @param $orderId
 * @param $sn
 * @param $payment_method
 * @param $phone
 * @param $total_price
 * @param $referrer
 */
function getOrderMss($user_id,$orderId,$sn,$payment_method,$phone,$total_price,$referrer,$supplier_id){
    $gourl=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/order-detail','order_id'=>$orderId,'supplier_id'=>$supplier_id]);
    $method=Order::method($payment_method);

    $first="订单提交成功！";
    $remark="点击左下角“详情”可查看更多！！";
    $openId=$user_id;
	//$openId=$user_id.",oV1VUt6RUheAI-xfveukXdNW2ak8";
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

    $supplier=Sumpplier::findOne($supplier_id);
    $message=$supplier['message'];
    if($message!=''){
        $first1="系统收到了一条新的订单。";
        $remark1="请相关人员尽快和他(/她)取得联系并确认安排出货！！";
        $opid=$message;
       if($referrer!='0'){
            $re_member=Member::findOne($referrer);
            $re_rank=$re_member->rank;
            if($re_rank>1){
                $opid.=','.$referrer;
            }
        }
        $openId1=$opid;
		//$openId1=$opid.",oV1VUt6RUheAI-xfveukXdNW2ak8";
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
}

/**
 * 订单更新模板消息
 * @param $orderid
 * @param $sn
 * @param $orderstatus
 * @param $remark
 */
function getOrderupdate($user_id,$orderid,$sn,$orderstatus,$remark,$supplier_id,$order_user,$referrer){
    $supplier=Sumpplier::findOne($supplier_id);
    $message=$supplier['message'];
    if($message!='') {
        $opid=$message;
       if($referrer!='0'){
            $re_member=Member::findOne($referrer);
            $re_rank=$re_member->rank;
            if($re_rank>1){
                $opid.=','.$referrer;
            }
        }
    }
    $openId=$order_user.','.$user_id.','.$opid;
	//$openId=$order_user.','.$user_id.",oV1VUt6RUheAI-xfveukXdNW2ak8,".$opid;
    $mess_push=explode(',',$openId);
    $mess=array_unique($mess_push);

    $first='您好！您有一条订单状态更新！';
    $gourl=Yii::$app->urlManager->createAbsoluteUrl(['eshop/order/order-detail','order_id'=>$orderid,'supplier_id'=>$supplier_id]);
    $status=Order::status($orderstatus);
     $remarks='【备注：'.$remark.'】点击“详情”查看完整订单信息！';
    for($i=0;$i<count($mess);$i++){
        if(isset($mess[$i])){
            if($mess[$i]!=''){
                PushMessage::OrderupdateMessage($mess[$i],$first,$gourl,$sn,$status,$remarks);
            }}
    }
}




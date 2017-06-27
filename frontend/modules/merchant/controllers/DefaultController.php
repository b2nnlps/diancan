<?php

namespace frontend\modules\merchant\controllers;

use backend\modules\merchant\models\Agent;
use backend\modules\merchant\models\Cart;
use backend\modules\merchant\models\Product;
use backend\modules\merchant\models\Supplier;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use backend\modules\sys\models\WechatUser;

/**
 * Default controller for the `merchant` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * 商品列表
     * @param $sump_id
     * @return string
     */
    public function actionProductList($sid=''){

        $supplier = $this->findSupplier($sid);
        $rank=$supplier['rank'];
        if($rank!=1){
            $agent=Agent::find()->where(['supplier_id'=>$sid])->all();
            return $this->render('product-list',[
                'sid'=>$sid,
                'agent'=>$agent,
                'supplier'=>$supplier,
            ]);
        }else{
            throw new NotFoundHttpException('暂无此权限！！');
        }


    }

    /**
     * 商品详情
     * @param $id
     * @return string
     */
    public function actionCommodity($aid){
        $model = $this->findAgent($aid);
        $product_id=$model['product_id'];
        $supplier_id=$model['supplier_id'];
        $product= $this->findProduct($product_id);
        $supplier=$this->findSupplier($supplier_id);
        $rank=$supplier['rank'];
        if($rank!=1){
            return $this->render('commodity',[
                'model'=>$model,
                'product'=>$product,
                'supplier'=>$supplier,
            ]);
        }else{
             throw new NotFoundHttpException('暂无此权限！！');
        }
    }

 public function actionMore(){
        $list_num = $_POST['list_num'];  //记录条数
        $amount = $_POST['amount'];      //一次查询多少条
        $product_id=$_POST['product_id'];
        $connection = Yii::$app->db;
        $sql = "select * from   {{%merchant_orderproduct}} where product_id=$product_id and status=10  order by id desc limit $list_num,$amount";
        $command=$connection->createCommand($sql);
        $orderproduct=$command->queryAll();

        if(empty($orderproduct)) {
            echo 'not_more';
        }else {
            for($i=0;$i<count($orderproduct);$i++) {
                $rh_openid=$orderproduct[$i]['rh_openid'];
                $member=\backend\modules\merchant\models\Member::find()->where(['rh_openid'=>$rh_openid])->one();
                $wx_openid=$member['wx_openid'];
                $headimgurl=WechatUser::getHeadimgurl($wx_openid);
                $nickname=WechatUser::getNickname($wx_openid);
                echo <<<Eof
                 <dl class="lists">
                        <dt><img src="{$headimgurl}"></dt>
                        <dd>
                            <h4>{$nickname}</h4>
                            <span>{$orderproduct[$i]['time']}&nbsp;&nbsp;订购：{$orderproduct[$i]['number']} {$orderproduct[$i]['sku']}</span>
                        </dd>
                        <div class="clear"></div>
                    </dl>
Eof;
            };
        }
    }
    /**
     * 添加购物车
     * @return string
     */
    public function actionAddCart(){
//        $rh_openid=$this->rh_openid;//操作人
        $session = Yii::$app->session;
        $sessionVal=$session['fxsc_cart'];//获取session值
        if (!isset($sessionVal)){//检测是否存在
            $session['fxsc_cart']=md5(time() . mt_rand(1,1000000));//设置session值
        }
        echo $sessionVal=$session['fxsc_cart'];//获取session值

        $agentPid = Yii::$app->request->post('agentPid');//加入购物车的代理商商品ID
        $number = Yii::$app->request->post('number');//加入购物车数量
        $agent=$this->findAgent($agentPid);//代理商品
        $supplier_id=$agent['supplier_id'];//代理商
        $product_id=$agent['product_id'];//代理商品ID
//        $stock=$agent['stock'];//库存
        $bookable=$agent['bookable'];//可预订库存
        $price=$agent['price'];//售价
        $product=$this->findProduct($product_id);
        $cart = Cart::find()->where([ 'product_id'=>$agentPid,'session_id'=>$sessionVal])->one();
        if(empty($cart)){
            if ($bookable>= $number) {
                $cart = new Cart();
                $cart->session_id =$sessionVal;
//                $cart->rh_openid = ''? 0 : $rh_openid;
                $cart->supplier_id =$supplier_id;
                $cart->product_id = $agentPid;
                $cart->number = $number;
                $cart->sku = $product['sku'];;
                $cart->name =$product['name'];;
                $cart->price =$price;
                $cart->status =1;
                $cart->number = $number;
                $cart->time =date("Y-m-d H:i:s");
                $cart->save();
            } else {
                return $strResult='下单失败2！';
            }
        }else{

            if ($number<=$bookable&&$number>0) {
                $cart->number = $number;
                $cart->time =date("Y-m-d H:i:s");
                $cart->save();
            }elseif ($number==0){
                $cart->delete();
            } else {
                return $strResult='下单失败！';
            }
        }
    }
    /**
     * 删除购物车
     */
    public function actionDeleteCart(){
        $id= Yii::$app->request->post('cartId');
        Cart::findOne($id)->delete();
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
    protected function findSupplier($id){
        if (($model = Supplier::findOne($id)) !== null) {
            Supplier::updateAllCounters(['pv' => 1], ['id' => $id]);//浏览次数加1
            return $model;
        } else {
            throw new NotFoundHttpException('所请求页面不存在！');
        }
    }




}

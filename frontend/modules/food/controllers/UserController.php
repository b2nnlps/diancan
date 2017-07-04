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
    public $layout=false;

    public function actionIndex($shop=1,$table=0)
    {
        if($shop && isset($_COOKIE['shop'])) if($shop!=$_COOKIE['shop']) setcookie('cart','',time()-1,'/');

        if($shop)setcookie("shop",$shop,time()+86400*7,"/");
        if($table)setcookie("table",$table,time()+86400*7,"/");

        $food = Food::getFoodList($shop);
        $shop=Shop::findOne($shop);
        return $this->render('index2',['food'=>$food,'shop'=>$shop]);
    }
    public function actionDetail($id){
        $food=Food::findOne($id);
        $shop=Shop::findOne($food['shop_id']);
        $stock=Food::getStock($id);
        $order=Order::getFoodOrder($id);
        setcookie("shop",$food['shop_id'],time()+86400*7,"/");
        return $this->render('detail2',['food'=>$food,'shop'=>$shop,'order'=>$order,'stock'=>$stock]);
    }
    public function actionCart(){//购物车
       $cart=null;
        if(isset($_COOKIE['cart'])) {
            $cookie = $_COOKIE['cart'];
            $cookie = json_decode($cookie, true);
            $cart   = $cookie['cart'];
        }

        $u=User::findOne($this->openid);
        return $this->render('cart',['cart'=>$cart,'u'=>$u]);
    }
    public function actionOrder($menu){//放cookie
        if(!isset($_COOKIE['cart']))  return self::actionCart();

        $cookie=$_COOKIE['cart'];
        $cookie=json_decode($cookie,true);
        $cart=$cookie['cart'];
        if(!count($cart))  return self::actionCart();
        $total_price=0;
        $total_number=0;
        $text='';$foods=[];
        for($i=0;$i<count($cart);$i++){
            if($cart[$i]['num']<=0) continue;
            if(strpos($menu,$cart[$i]['id'].',')===false) continue;//如果没有选中，则跳过
            $info=FoodInfo::findOne($cart[$i]['id']);
            if($info){
                if(!isset($foods[$info['food_id']])){//免去重复查询数据库
                    $foods[$info['food_id']]=Food::findOne($info['food_id']);
                }
                $food=$foods[$info['food_id']];
                $total_number+=$cart[$i]['num'];
                $total_price+=$info['price']*$cart[$i]['num'];
                $text.='<dl class="clearfix"><dt>
<h5>'.$food['name'].'-'.$info['title'].'</h5>
<span>'.$cart[$i]['text'].'</span></dt><dd>
<span class="amount_box">X'.$cart[$i]['num'].'</span>
<span class="price_box">￥'.$info['price']*$cart[$i]['num'].'</span></dd></dl>';
            }
        }

      //  if($food)setcookie("shop",$food['shop_id'],time()+86400*7,"/"); else return self::actionIndex();
        $u=User::findOne($this->openid);
        return $this->render('order2',['text'=>$text,'total_price'=>$total_price,'total_number'=>$total_number,'u'=>$u]);
    }

    public function actionPayOrder(){//生成订单并支付

        $cookie=$_COOKIE['cart'];
        $cookie=json_decode($cookie,true);
        $cart=$cookie['cart'];

        if(count($cart)==0) return '您未选购菜品';

        $request=Yii::$app->request;
        $total_price=0;
        $text='';
        $name=$request->post('name',' ');
        $phone=$request->post('phone',' ');
        $notic=$request->post('notic',' ');
        $menu=$request->post('menu',' ');
        $table=$request->post('table',isset($_COOKIE['table'])?$_COOKIE['table']:'');

        User::newUser($this->openid,$name,$phone,$notic);

        $staff=ShopStaff::findOne(['shop_id'=>$_COOKIE['shop'],'openid'=>$this->openid,'status'=>0]);
        $order=Order::newOrder($this->openid,$_COOKIE['shop'],'0',$name,$phone,$table,$staff,$notic);

        $foods=[];
        $total=0;
        for($i=0;$i<count($cart);$i++){
            if(strpos($menu,$cart[$i]['id'].',')===false) continue;//如果没有选中，则跳过
            $info=FoodInfo::findOne($cart[$i]['id']);
            if($info && $cart[$i]['num']>0) {
                if(!isset($foods[$info['food_id']])){//免去重复查询数据库
                    $foods[$info['food_id']]=Food::findOne($info['food_id']);
                }
                $food=$foods[$info['food_id']];
                $total_price += $food['price'] * $cart[$i]['num'];
                $text .= $food['name'] . '   x' . $cart[$i]['num'] . '  ￥' . $food['price'] * $cart[$i]['num'] / 100 . '<br>';
                $total+=$food['price'] * $cart[$i]['num'];
                OrderInfo::newOrderInfo($order->id,$info['food_id'],$info['price']*100,$cart[$i]['num'],$cart[$i]['text']);
            }
        }
        $order->total=$total;
        $order->save();

        if($staff){
            setcookie('cart','',time()-1,'/');

            $s="http://ms.n39.cn/food/default/push-mess?orderno=$order->id";
            $s = str_replace(" ", "", $s);
            $text2 = file_get_contents($s);

            return $this->render('shop-success',['shop_id'=>$order['shop_id']]);
           // header("Location: http://ms.n39.cn/food/default/push-mess?orderno=$order->id");
        }else
         echo "Location: http://ms.n39.cn/wxpayapi/n_food_pay.php?order_id=$order->id";
         //   header("Location: http://ms.n39.cn/wxpayapi/n_food_pay.php?order_id=$order->id");
        exit;
    }
    public function actionPaySuccess(){//支付完毕

        setcookie('cart','',time()-1,'/');

        return $this->render('success');
    }
    public function actionMyOrder($status=1){
        $o=Order::find()->where(['user'=>$this->openid,'status'=>$status])->orderBy("id desc")->all();

        return $this->render('my-order',['o'=>$o,'status'=>$status]);
    }

/*
    public function actionShopImg(){
       $food=Food::find()->all();
        foreach($food as $_food){
            $imgs=explode(',', $_food['img']);
            if($imgs[0]!=""){
                $_food['head_img']=$imgs[0];
                $_food->save();
            }
        }

    }*/


}

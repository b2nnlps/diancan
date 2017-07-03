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

        $food = (new \yii\db\Query())
            ->select(['a.id', 'a.name as fname','head_img','b.img','c.price','b.name as cname','a.sold_number','a.status','c.id as iid','c.title'])
            ->from('n_food_food a')
            ->leftJoin('n_food_food_info c','a.id=c.food_id')
            ->rightJoin('n_food_classes b','a.class_id = b.id')
            ->where('a.shop_id=:shop_id AND (status=0 OR status=1)',[':shop_id'=>$shop])
            ->orderBy('class_id')
            ->all();

        return $this->render('index2',['food'=>$food]);
    }
    public function actionDetail($id){
        $food=Food::findOne($id);
        setcookie("shop",$food['shop_id'],time()+86400*7,"/");
        return $this->render('detail',['food'=>$food]);
    }
    public function actionCart(){//购物车
        $cookie=$_COOKIE['cart'];
        $cookie=json_decode($cookie,true);
        $cart=$cookie['cart'];

        $u=User::findOne($this->openid);
        return $this->render('cart',['cart'=>$cart,'u'=>$u]);
    }
    public function actionOrder(){//放cookie
        $cookie=$_COOKIE['cart'];
        $cookie=json_decode($cookie,true);
        $cart=$cookie['cart'];
        $total_price=0;
        $total_number=0;
        $text='';$foods=[];
        for($i=0;$i<count($cart);$i++){
            if($cart[$i]['num']<=0) continue;
            $info=FoodInfo::findOne($cart[$i]['id']);
            if($info){
                if(!isset($food[$info['food_id']])){//免去重复查询数据库
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
    public function actionOrder2(){//放cookie
        $cookie=$_COOKIE['cart'];
        $cookie=json_decode($cookie,true);
        $cart=$cookie['cart'];
        $total_price=0;
        $text='';$food=false;
        for($i=0;$i<count($cart);$i++){
            if($cart[$i]['num']<=0) continue;
            $food=Food::findOne($cart[$i]['id']);
            $total_price+=$food['price']*$cart[$i]['num'];
            $text.=" <span>$food[name]</span><em>x".$cart[$i]['num']."</em><cite>￥".$food['price']*$cart[$i]['num'] ."</cite>";
        }

        if($food)setcookie("shop",$food['shop_id'],time()+86400*7,"/"); else return self::actionIndex();
        $u=User::findOne($this->openid);
        return $this->render('order',['text'=>$text,'total_price'=>$total_price,'u'=>$u]);
    }


    public function actionPayOrder(){//生成订单并支付

        $cookie=$_COOKIE['cart'];
        $cookie=json_decode($cookie,true);
        $cart=$cookie['cart'];

      /*  $foods=explode(',',$_COOKIE['foods_id']);
        $nums=explode(',',$_COOKIE['nums']);
        $types=explode(',',$_COOKIE['types']);
        $texts=explode(',',$_COOKIE['texts']);*/

        if(count($cart)==0) return '您未选购菜品';

        $request=Yii::$app->request;
        $total_price=0;
        $text='';
        $name=$request->post('name',' ');
        $phone=$request->post('phone',' ');
        $notic=$request->post('notic',' ');
        $table=$request->post('table',isset($_COOKIE['table'])?$_COOKIE['table']:'');

        $u=User::findOne($this->openid);
        if(!$u){$u=new User();$u->openid=$this->openid;}
        $u->realname=$name;
        $u->phone=$phone;
        $u->notic=$notic;
        $u->save();

        $order=new Order();
        $order->user=$this->openid;
        $order->shop_id=$_COOKIE['shop'];
        $order->orderno='0';
        $order->realname=$name;
        $order->phone=$phone;
        $order->table=$table;
        $order->text=$name . $phone."\n备注：$notic" ."\n桌号：" .$table;
        $staff=ShopStaff::findOne(['shop_id'=>$_COOKIE['shop'],'openid'=>$this->openid,'status'=>0]);
        if($staff)  //如果是服务员就直接当做付款
            $order->status=3;
        else
            $order->status=0;

        $order->created_time=date("Y-m-d H:i:s");
        $order->updated_time=date("Y-m-d H:i:s");
        $order->save();
        $total=0;
        for($i=0;$i<count($cart);$i++){
            $food=Food::findOne($cart[$i]['id']);
            if($food && $cart[$i]['num']>0) {
                $total_price += $food['price'] * $cart[$i]['num'];
                $text .= $food['name'] . '   x' . $cart[$i]['num'] . '  ￥' . $food['price'] * $cart[$i]['num'] / 100 . '<br>';
                $total+=$food['price'] * $cart[$i]['num'];
                $info = new OrderInfo();
                $info->order_id = $order->id;
                $info->food_id = $food['id'];
                $info->price=$food['price'];
                $info->num=$cart[$i]['num'];
                $info->type='*';
                $info->text='*';
                $info->save();
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
            header("Location: http://ms.n39.cn/wxpayapi/n_food_pay.php?order_id=$order->id");
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

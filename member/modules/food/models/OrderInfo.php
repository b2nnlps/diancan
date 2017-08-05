<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_order_info".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $food_id
 * @property integer $price
 * @property integer $num
 * @property string $info_id
 * @property string $text
 * @property integer $status
 */
class OrderInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_order_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'food_id', 'info_id', 'price', 'num'], 'required'],
            [['order_id', 'food_id', 'info_id', 'price', 'num', 'status'], 'integer'],
            [['text'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '订单id',
            'food_id' => '菜品id',
            'price' => '价格（分）',
            'num' => '数量',
            'info_id' => '规格id',
            'text' => '要求备注',
            'status' => '状态',
        ];
    }
    public static function newOrderInfo($order_id,$food_id,$type,$price,$num,$text){
        $info = new OrderInfo();
        $info->order_id = $order_id;
        $info->food_id = $food_id;
        $info->price=$price;
        $info->num=$num;
        $info->info_id=$type;
        $info->text=$text;
        if(!$info->save())var_dump($info->getErrors());
        return $info;
    }
    public static function getOrderInfo($shop_id,$order_id){//获取订单的详情菜品信息
        $orderInfo = (new \yii\db\Query())
            ->select(['b.text','b.price','b.num','a.name','c.title as type'])
            ->from('n_food_food a,n_food_order_info b,n_food_food_info c')
            ->where('a.id=b.food_id AND b.info_id=c.id AND order_id=:order_id AND a.shop_id=:shop_id',[':shop_id'=>$shop_id,':order_id'=>$order_id])
            ->orderBy('a.created_time')
            ->all();
        return $orderInfo;
    }

    public static function getUserOrderInfo($user, $order_id)
    {//获取订单的详情菜品信息
        $order = Order::findOne(['user' => $user, 'id' => $order_id]);
        if (!$order) return false;
        $orderInfo = (new \yii\db\Query())
            ->select(['b.text', 'b.price', 'b.num', 'a.name'])
            ->from('n_food_food a,n_food_order_info b')
            ->where('a.id=b.food_id AND order_id=:order_id', [':order_id' => $order_id])
            ->orderBy('a.created_time')
            ->all();
        return $orderInfo;
    }
}

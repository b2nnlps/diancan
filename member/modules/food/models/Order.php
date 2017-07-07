<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_order".
 *
 * @property integer $id
 * @property integer $num
 * @property string $user
 * @property integer $shop_id
 * @property string $orderno
 * @property string $text
 * @property integer $type
 * @property integer $print
 * @property integer $status
 * @property string $created_time
 * @property string $updated_time
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num', 'shop_id', 'status','print'], 'integer'],
            [['shop_id', 'orderno', 'status', 'created_time', 'updated_time'], 'required'],
            [['text'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['user'], 'string', 'max' => 255],
            [['orderno','table'], 'string', 'max' => 100],
            [['phone','realname'], 'string', 'max' => 20],
            [['total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num' => '今日订单号',
            'user' => 'User',
            'shop_id' => '店家',
            'phone' => '手机号码',
            'realname' => '姓名',
            'table' => '桌号',
            'total' => '总价',
            'orderno' => 'Orderno',
            'text' => '备注',
            'status' => '0待支付1已支付2已完成',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }
    public static function newOrder($openid,$shop_id,$orderno,$realname,$phone,$table,$staff,$text){
        $order=new Order();
        $order->user=$openid;
        $order->shop_id=$shop_id;
        $order->orderno=$orderno;
        $order->realname=$realname;
        $order->phone=$phone;
        $order->table=$table;
        $order->text=$realname . $phone."\n备注：$text" ."\n桌号：" .$table;
        if($staff)  //如果是服务员就直接当做付款
            $order->status=3;
        else
            $order->status=0;

        $order->created_time=date("Y-m-d H:i:s");
        $order->updated_time=date("Y-m-d H:i:s");
        if(!$order->save())var_dump($order->getErrors());
        return $order;
    }
    public static function getFoodOrder($food_id){
        $food = (new \yii\db\Query())
            ->select(['nickname','headimgurl','a.created_time','b.num'])
            ->from('n_food_order a,n_food_order_info b,t_sys_wechat_user c')
            ->where('a.id=b.order_id AND a.user=c.openid AND food_id=:food_id',[':food_id'=>$food_id])
            ->orderBy('a.created_time')
            ->all();
        return $food;
    }
    public static function getJFoodOrder($openid,$type=1){
        $food = (new \yii\db\Query())
            ->select(['a.created_time','name','total'])
            ->from('n_food_order a,n_food_shop b')
            ->where('a.shop_id=b.id AND a.user=:openid AND type=:type',[':openid'=>$openid,':type'=>$type])
            ->orderBy('a.created_time')
            ->all();
        return $food;
    }
}

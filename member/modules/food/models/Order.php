<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_order".
 *
 * @property string $id
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
            [['num', 'shop_id', 'status', 'print', 'people'], 'integer'],
            [['shop_id', 'orderno', 'status', 'created_time', 'updated_time'], 'required'],
            [['text'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['user'], 'string', 'max' => 255],
            [['orderno', 'table', 'id'], 'string', 'max' => 100],
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
            'user' => 'OpenID',
            'shop_id' => '店家',
            'phone' => '手机号码',
            'realname' => '姓名',
            'table' => '桌号',
            'people' => '就餐人数',
            'total' => '总价',
            'orderno' => '订单编号',
            'text' => '备注',
            'status' => '状态',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }

    public static function status($key = null)
    {
        $arr = [
            '0' => '待支付',
            '1' => '已支付',
            '2' => '已完成',
            '3' => '现金支付',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    public static function newOrder($openid, $shop_id, $orderno, $realname, $phone, $table, $people, $staff, $text)
    {
        $order=new Order();
        $order->user=$openid;
        $order->shop_id=$shop_id;
        $order->orderno=$orderno;
        $order->realname=$realname;
        $order->phone=$phone;
        $order->table=$table;
        $order->people = $people;
        $order->text=$text;
        if ($staff)  //如果是服务员就直接现金支付
            $order->status=3;
        else
            $order->status=0;
        $num = Order::find()->where('shop_id=:shop_id AND status !=0  AND updated_time LIKE :updated_time', [':shop_id' => $shop_id, ':updated_time' => '%' . date("Y-m-d") . '%'])->count();
        $order->num = $num + 1; //今日订单数
        $order->id = $shop_id . date("ymd") . str_pad($order->num, 3, '0', STR_PAD_LEFT);

        $order->created_time=date("Y-m-d H:i:s");
        $order->updated_time=date("Y-m-d H:i:s");
        if(!$order->save())var_dump($order->getErrors());
        return $order;
    }
    public static function getFoodOrder($food_id){//获取该商品的销售信息
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

    public static function getWaitOrderInfo($shop_id, $status = false, $sort = "DESC")
    {
        if($status===false)$status=''; else $status=' AND b.status='.$status;
        $order=(new \yii\db\Query())
            ->select(['b.text', 'a.table', 'b.id', 'b.food_id', 'b.info_id', 'b.num', 'b.status', 'b.operator', 'b.updated_time'])
            ->from('n_food_order a,n_food_order_info b')
            ->where('a.id=b.order_id AND a.shop_id=:shop_id'.$status,[':shop_id'=>$shop_id])
            ->orderBy("b.updated_time $sort")
            ->limit(50)
            ->all();
        return $order;
    }

    public static function printOrder($o,$device_id)
    { //该函数只负责打印
        $info = OrderInfo::findAll(['order_id' => $o['id']]);
        $text = self::charsetToGBK("# " . $o['num']) . "\n";
        $text .= '================================';
        $total = 0;
        $i = 0;
        foreach ($info as $_info) {
            $foodInfo = FoodInfo::findOne($_info['info_id']);
            $food = Food::findOne($foodInfo['food_id']);
            $i++;
            if (strlen($foodInfo['title']) > 0)//是否有规格
                $text .= self::change($i . '.' . $food['name'] . "(" . $foodInfo['title'] . ")", '￥' . $foodInfo['price'], '  x' . $_info['num']);
            else
                $text .= self::change($i . '.' . $food['name'], '￥' . $foodInfo['price'], '  x' . $_info['num']);
            $total += $foodInfo['price'] * $_info['num'];
        }
        $total = round($total, 2);
        $text .= self::charsetToGBK("\n订单编号：" . $o['id']) . "\n";
        $text .= self::charsetToGBK("就餐桌号：" . $o['table']) . "\n";
        $text .= self::charsetToGBK('联系电话：' . $o['phone']) . "\n";
        $text .= self::charsetToGBK('订单备注：' . $o['text']) . "\n";
        $text .= self::charsetToGBK('下单时间：' . date("Y-m-d H:i:s")) . "\n";
        $text .= self::charsetToGBK("消费金额：￥" . $total . "\n");
        $text .= self::charsetToGBK("支付状态：（" . self::status($o['status']) . "）\n");
        $text .= "================================";

        Order::TcpSend($device_id, $o['id'], $text);

        return true;
    }

    public static function charsetToGBK($mixed)
    {
        if (is_array($mixed)) {
            foreach ($mixed as $k => $v) {
                if (is_array($v)) {
                    $mixed[$k] = self::charsetToGBK($v);
                } else {
                    $encode = mb_detect_encoding($v, array('ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5'));
                    if ($encode == 'UTF-8') {
                        $mixed[$k] = iconv('UTF-8', 'GBK', $v);
                    }
                }
            }
        } else {
            $encode = mb_detect_encoding($mixed, array('ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5'));
            //var_dump($encode);
            if ($encode == 'UTF-8') {
                $mixed = iconv('UTF-8', 'GBK', $mixed);
            }
        }
        return $mixed;
    }

    public static function change($a, $b, $c)
    {  //转换格式，对齐
        $a = self::charsetToGBK($a);
        $num = strlen($a) + strlen($b) + strlen($c);
        $kong = (intval($num / 32) + 1) * 32;
        return $a . str_repeat(' ', $kong - $num) . self::charsetToGBK($b) . $c . "\n";
    }

    public static function TcpSend($print_id, $order_id, $text, $end = '0')
    {  //发送命令给打印机 打印机编号，订单编号，内容
        $pass = false;
        //  $host = "121.42.24.85";
        $host = "127.0.0.1";
        $port = 45613;

        while ($pass == false) {
            try {
                $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                $connection = socket_connect($socket, $host, $port);
                socket_write($socket, $end . '-' . $print_id . '-' . $order_id . '-|' . $text);//十六进制
                $pass = true;
                socket_close($socket);
                //  echo '下单成功';
                //socket_shutdown($socket);
            } catch (Exception $e) {
                echo '失败';
            }
        }
        return date("H:i:s");
    }
}

<?php

namespace frontend\modules\food\controllers;

use member\modules\food\models\FoodInfo;
use Yii;
use yii\web\Controller;
use member\modules\food\models\Food;
use member\modules\food\models\Shop;
use member\modules\food\models\Order;
use member\modules\food\models\Table;
use member\modules\food\models\OrderInfo;
use member\modules\food\models\ShopStaff;
use member\modules\food\models\Device;
use common\wechat\JSSDK;
use common\wechat\Wechat;

/**
 * Default controller for the `food` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionPushMess($orderno){    //传TIME是为了检验码防止乱打印
        $session = Yii::$app->session;
       if($session->has('orderno') && $session['orderno']==$orderno) return '该订单打印过.';
        $o = Order::find()->where('id = :id AND (status = 1 OR status=3)', [':id' => $orderno])->one();//已支付或者店员下单的现金支付
        if($o){
            $table = Table::find()->where('shop_id = :shop_id AND `table` like :table', [':shop_id' => $o['shop_id'], ':table' => $o['table']])->one();
            if ($table)//获取桌号对应的打印机
                Order::printOrder($o, $table['device_id']);
            else {//默认打印机
                $table = Table::find()->where(['table' => '-1', 'shop_id' => $o['shop_id']])->one();
                Order::printOrder($o,$table['device_id']);//判断完后开始打印
            }

            $device = explode(',', $table['device_id']);//加入打印机等待状态队列
            foreach ($device as $_device)
                if (strlen($_device) > 0) Device::newDevice($_device, $o['id']);

            $session['orderno']=$orderno;
            self::WechatMessage($o['user'], $o['id'], round($o['total'], 2), $o['table'], $o['status'] == 1 ? '线上已支付' : '现金待支付', '出单中...');

            $orderInfo = OrderInfo::find()->where(['order_id' => $o['id']])->all();//更新销量和库存
            foreach ($orderInfo as $_info) {
                $food = Food::findOne($_info['food_id']);
                $food['sold_number'] = $food['sold_number'] + $_info['num'];
                $food->save();
                $foodInfo = FoodInfo::findOne($_info['info_id']);
                $foodInfo['number'] = $food['sold_number'] - $_info['num'];
                $foodInfo->save();
            }
        }
        return $this->renderPartial('success');
    }

    public function actionGetPrint()
    {//获取打印等待队列并自动打印 用软件定时触发的
        $device = Device::find()->where('(status = 0 OR status=2) AND updated_time >= :time', [':time' => date("Y-m-d H:i:s", time() - 1800)])->all();
        foreach ($device as $_device) {//遍历所有待打印队列中的信息
            $o = Order::findOne($_device['order_id']);
            if ($o)
                Order::printOrder($o, $_device['device_id']);//推送给打印机打印信息
        }
        if ($device)
            return "SUCCESS";
        else
            return 0;
    }

    public function actionCheckPrinter($order_id, $device_id, $status)
    {  //提交订单打印机的打印状态
        $o = Device::findOne(['order_id' => $order_id, 'device_id' => $device_id]);
        $o['status'] = $status;
        $o['updated_time'] = date("Y-m-d H:i:s");
        $o->save();
    }

    public function actionCheckOrder($id,$print){  //提交订单是否打印状态
        $o=Order::findOne($id);
        if($o){
            $o['print']=$print;
            $o->save();
            return 1;
            switch($print){
                case 1: //1 服务器发送成功
                    //self::WechatMessage($o['user'],$o['num'],'','1号','','服务器发送成功');
                    break;
                case 2: //2 服务器发送失败
                    $staff=ShopStaff::findAll(['shop_id'=>$o['shop_id']]);  //发送给厨房或者店员
                    foreach($staff as $_staff)
                        self::WechatMessageReport($_staff['openid'],'您好，您的设备出现了警告','连接出错',date("Y-m-d H:i:s"),'服务器发送失败，设备未在线');
                    break;
                case 3://3 打印机连接失败
                    $staff=ShopStaff::findAll(['shop_id'=>$o['shop_id']]);
                    foreach($staff as $_staff)
                    self::WechatMessageReport($_staff['openid'],'您好，您的设备出现了警告','设备出错',date("Y-m-d H:i:s"),'未连接打印机');
                    break;
                case 4://4 打印成功

                    break;
            }
        }
    }
	
	public static function actionTcpSend($print_id,$order_id,$text){  //debug发送命令给打印机 打印机编号，订单编号，内容
        $pass=false;
        //  $host = "121.42.24.85";
        $host = "127.0.0.1";
        $port = 45613;
		
		$text=str_replace("<n>","\n",$text);
		$text="#$order_id \n".$text."\n\n";
        while($pass==false){
            try{
                $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                $connection = socket_connect($socket, $host, $port);
                socket_write($socket, '0-'.$print_id.'-'.$order_id.'-|'.$text);//十六进制
                $pass=true;
                socket_close($socket);
                echo '下单成功 ';
                //socket_shutdown($socket);
            }catch(Exception $e){echo '失败';}
        }
        echo date("H:i:s");
    }

    public static function WechatMessage($openid,$a1,$a2,$a3,$a4,$remark)
    {
        $access_token_2=new JSSDK();
        $access_token=$access_token_2->getAccessToken('wechat');
        $url  = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $touser=$openid;

        $content=array("touser"=>$touser,
            "template_id"=>"MEMt4lAYBITWFHKfWdqspY2O6bSw3EOAGu9tqdOIFNU",
            "url" => 'http://ms.n39.cn/food/user/order-detail?order_id=' . $a1,
            "topcolor"=>"#FF0000",
            "data" => array("first" => array("value" => '欢迎光临', "color" => "#CD453B"),
                "keyword1"=>array("value"=>$a1,"color"=>"#2B9F65"),
                "keyword2"=>array("value"=>$a2,"color"=>"#5785CF"),
                "keyword3"=>array("value"=>$a3,"color"=>"#5785CF"),
                "keyword4"=>array("value"=>$a4,"color"=>"#5785CF"),
                "remark"=>array("value"=>$remark,"color"=>"#D19B43"))
        );
        $data = json_encode($content);
        return  self::do_post_request($url, $data);
    }
    public static function WechatMessageReport($openid,$first,$a1,$a2,$remark)
    {
        $access_token_2=new JSSDK();
        $access_token=$access_token_2->getAccessToken('wechat');
        $url  = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $touser=$openid;

        $content=array("touser"=>$touser,
            "template_id"=>"dDacXiNKewUB5gdm8lO1or5YvcqNwsKcH6XOI2AAo_o",
            "url"=>'',    //打开跳转到那个标签
            "topcolor"=>"#FF0000",
            "data"=>array("first"=>array("value"=>$first,"color"=>"#CD453B"),
                "keyword1"=>array("value"=>$a1,"color"=>"#2B9F65"),
                "keyword2"=>array("value"=>$a2,"color"=>"#5785CF"),
                "remark"=>array("value"=>$remark,"color"=>"#D19B43"))
        );
        $data = json_encode($content);
        return  self::do_post_request($url, $data);
    }
    public static function do_post_request($url, $data, $optional_headers = null)
    {
        $params = array('http' => array(
            'method' => 'POST',
            'content' => $data
        ));
        if ($optional_headers !== null) {
            $params['http']['header'] = $optional_headers;
        }
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if (!$fp) {
            //throw new Exception("Problem with $url, $php_errormsg");
        }
        $response = @stream_get_contents($fp);
        if ($response === false) {
            // throw new Exception("Problem reading data from $url, $php_errormsg");
        }
        return $response;
    }

    public function actionQr($str, $a, $b)
    {
        for ($i = $a; $i <= $b; $i++) {
            $scene_id = $str . $i;//场景值
            $params = Yii::$app->params['wechat_hnyj'];
            $wechat = new Wechat($params);
            $access_token_2 = new JSSDK();
            $access_token = $access_token_2->getAccessToken();
            $QRCode = $wechat->getQRCode($scene_id, $type = 1, $expire = 2592000, $access_token);//微信创建永久二维码ticket
            $ticket = $QRCode['ticket'];//创建二维码ticket
            $QRUrl = $wechat->getQRUrl($ticket);//获取二维码图片地址
            echo "<img src='$QRUrl'>$scene_id <br>";
        }
    }
}

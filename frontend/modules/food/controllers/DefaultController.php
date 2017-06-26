<?php

namespace frontend\modules\food\controllers;

use Yii;
use yii\web\Controller;
use member\modules\food\models\Food;
use member\modules\food\models\Shop;
use member\modules\food\models\Order;
use member\modules\food\models\OrderInfo;
use member\modules\food\models\ShopStaff;
use common\wechat\JSSDK;

/**
 * Default controller for the `food` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($shop=1,$table=1)
    {die;
        $shop=Shop::findOne($shop);
        setcookie("table",$table,time()+86400*7,"/");
        $food=Food::findAll(['menu_id'=>$shop['menu']]);
        var_dump($food);

        return $this->render('index');
    }

    function charsetToGBK($mixed)
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

    public function change($a,$b,$c){  //转换格式，对齐
        $a=self::charsetToGBK($a);
        $num=strlen($a)+strlen($b)+strlen($c);
        return $a.str_repeat(' ',31-$num).self::charsetToGBK($b).$c."\n";
    }

    public function actionPushMess($orderno){    //传TIME是为了检验码防止乱打印
        $session = Yii::$app->session;
       if($session->has('orderno') && $session['orderno']==$orderno) return '该订单打印过.';
        $o=Order::find()->where('id = :id AND (status = 1 OR status=3)',[':id'=>$orderno])->one();
        if($o){
            if($o['num']==null){
                $num=Order::find()->where('(status = 1 OR status = 3) AND updated_time LIKE :updated_time',[':updated_time'=>'%'.date("Y-m-d").'%'])->count();
                $o['num']=$num+1;
                $o->save();
            }
            $shop=Shop::findOne($o['shop_id']);
            $info=OrderInfo::findAll(['order_id'=>$o['id']]);
            $text=self::charsetToGBK("\n#".$o['num'])."\n";
            $text.='================================'; $total=0;$i=0;
            foreach($info as $_info){
                $food=Food::findOne($_info['food_id']);
                $i++;
                $text.=self::change($i.'.'.$food['name'],'￥'.$_info['price'],'  x'.$_info['num']);
                $total+=$food['price']*$_info['num'];
            }
            $total=round($total,2);
            $text.=self::charsetToGBK("\n订单编号：".$o['id'])."\n";
            $text.=self::charsetToGBK('订单信息：'.$o['text'])."\n";
            $text.=self::charsetToGBK('下单时间：'.date("Y-m-d H:i:s"))."\n";
            $text.=self::charsetToGBK("总消费：￥".$total."\n");
            $text.="================================\n\n";

            $session['orderno']=$orderno;

            self::TcpSend($shop['device_id'],$o['id'],$text);

            self::WechatMessage($o['user'],$o['id'],$total,$o['table'],$o['status']==1?'线上已支付':'现金待支付','出单中...');

        }
        return $this->renderPartial('success');
    }
    public  function actionGetPrint(){//获取有效期的订单 用软件定时触发的
        $o=Order::find()->where('(status = 1 OR status=3) AND print = 0 AND updated_time <= :time',[':time'=>date("Y-m-d H:i:s",time()+60)])->one();
        if($o) return self::actionPushMess($o['id']);
        return 0;
    }

    public function actionCheckOrder($id,$print){  //提交订单是否打印状态
        $o=Order::findOne($id);
        if($o){
            $o['print']=$print;
            $o->save();
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

    public static function TcpSend($print_id,$order_id,$text){  //发送命令给打印机 打印机编号，订单编号，内容
        $pass=false;
        //  $host = "121.42.24.85";
        $host = "127.0.0.1";
        $port = 45613;

        while($pass==false){
            try{
                $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                $connection = socket_connect($socket, $host, $port);
                socket_write($socket, '0-'.$print_id.'-'.$order_id.'-|'.$text);//十六进制
                $pass=true;
                socket_close($socket);
                echo '成功';
                //socket_shutdown($socket);
            }catch(Exception $e){echo '失败';}
        }
        echo date("H:i:s").'<br>';
    }

    public static function WechatMessage($openid,$a1,$a2,$a3,$a4,$remark)
    {
        $access_token_2=new JSSDK();
        $access_token=$access_token_2->getAccessToken('wechat');
        $url  = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $touser=$openid;

        $content=array("touser"=>$touser,
            "template_id"=>"MEMt4lAYBITWFHKfWdqspY2O6bSw3EOAGu9tqdOIFNU",
            "url"=>'http://ms.n39.cn/food/user/shop-order#'.$a1,    //打开跳转到那个标签
            "topcolor"=>"#FF0000",
            "data"=>array("first"=>array("value"=>'新订单',"color"=>"#CD453B"),
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
}

<?php
namespace common\wechat;

use Yii;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/23
 * Time: 9:57
 * 来源：http://www.cnblogs.com/txw1958/p/weixin-js-sharetimeline.html
 */


class JSSDK {

    public function __construct() {
        $this->appId = 'wxcc35caa63eb85f0f';
        $this->appSecret ='b48643495b789dbc30eb93b354096faf';
    }

    public function getSignPackage() {
        $jsapiTicket = $this->getJsApiTicket();
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    public function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }



    public function getJsApiTicket() {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例

       //$url_jsapi= dirname(__FILE__).'\jsapi_ticket.json';
        //$url_jsapi='D:\xampp\htdocs\msjlb.n39.cn\frontend\web\jsapi_ticket.json';
        //$url_jsapi= Yii::$app->getBasePath()."/web/jsapi_ticket.json";
		$url_jsapi="http://ms.n39.cn/jsapi_ticket.json";
        if(!file_exists($url_jsapi))
        {
            $fp = fopen("jsapi_ticket.json", "w");
            fwrite($fp, '{"jsapi_ticket":"","expire_time":0}');
            fclose($fp);
            $data = json_decode( '{"jsapi_ticket":"","expire_time":0}');
        }else{
            $data = json_decode(file_get_contents($url_jsapi));
        }

        if ($data->expire_time < time()) {
            $accessToken = $this->getAccessToken();
            // 如果是企业号用以下 URL 获取 ticket
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->httpGet($url));
            $ticket = $res->ticket;
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $fp = fopen("jsapi_ticket.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }

        return $ticket;
    }

    public function getAccessToken() {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例

//        $url_token= dirname(__FILE__).'\access_token.json';
//        $url_token='D:\xampp\htdocs\msjlb.n39.cn\frontend\web\access_token.json';
//        $url_token= Yii::$app->getBasePath()."/web/access_token.json";
        $url_token=" http://ms.n39.cn/access_token.json";
        if(!file_exists($url_token))
        {
            $fp = fopen("access_token.json", "w");
            fwrite($fp, '{"access_token":"","expire_time":0}');
            fclose($fp);
            $data = json_decode('{"access_token":"","expire_time":0}');
        }else{
            $data = json_decode(file_get_contents($url_token));
        }
        if ($data->expire_time < time()) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";

            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $fp = fopen("access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
}
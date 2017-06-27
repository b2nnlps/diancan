<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\wechat;

use Yii;
use common\wechat\JSSDK;

/**
 * Description of PushMessage
 *
 * @author Administrator
 */
class PushMessage {
    /**
     *{{first.DATA}}
     *订单号：{{keyword1.DATA}}
     *商品名称：{{keyword2.DATA}}
     *订购数量：{{keyword3.DATA}}
     *订单总额：{{keyword4.DATA}}
     *付款方式：{{keyword5.DATA}}
     *{{remark.DATA}}
     * @param $openId
     * @param $first
     * @param $gourl
     * @param $OrderID
     * @param $cmdtyName
     * @param $number
     * @param $unit_price
     * @param $total_price
     * @param $payment
     * @param $remark
     * @return string
     * author Fox
     */
    public static function OrderMessage($openId,$first,$gourl,$OrderID,$cmdtyName,$number,$total_price,$payment,$remark)
    {
        $access_token_2=new JSSDK();
        $access_token=$access_token_2->getAccessToken();
        $url  = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $content=array(
            "touser"=>$openId,
//            "touser"=>"oozXjwOYTO6HDC1GKpKGQFuQ-R-U",
            "template_id"=>"Ceeox6f1relP099wjjxbAAdVx3NpeOqZZoWfFOY64Hc",//下单成功通知
            "url"=>$gourl,
            "topcolor"=>"#FF0000",
            "data"=>array(
                "first"=>array("value"=>$first,"color"=>"#CD453B"),
                "keyword1"=>array("value"=>$OrderID,"color"=>"#2B9F65"),
                "keyword2"=>array("value"=>$cmdtyName,"color"=>"#5785CF"),
                "keyword3"=>array("value"=>$number,"color"=>"#D19B43"),
                "keyword4"=>array("value"=>$total_price,"color"=>"#743A3A"),
                "keyword5"=>array("value"=>$payment,"color"=>"#743A3A"),
                "remark"=>array("value"=>$remark,"color"=>"#008000")
            )
        );
        $data = json_encode($content);
        return  $access_token.self::do_post_request($url, $data);
    }
        /**
     * {{first.DATA}}
     * 订单编号：{{keyword1.DATA}}
     * 订单类型：{{keyword2.DATA}}
     * 联系电话：{{keyword3.DATA}}
     * 总金额：{{keyword4.DATA}}
     * 订单创建时间：{{keyword5.DATA}}
     * {{remark.DATA}}
     * @param type $openId
     * @param type $first1
     * @param type $gourl
     * @param type $sn
     * @param type $method
     * @param type $phone
     * @param type $total_price
     * @param type $remark1
     * @return type
     */
     public static function NeworderMessage($openId,$first1,$gourl,$sn,$method,$phone,$total_price,$remark1)
    {
        $access_token_2=new JSSDK();
        $access_token=$access_token_2->getAccessToken();
        $url  = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $content=array(
            "touser"=>$openId,
            "template_id"=>"X7smdNp8G2n9-NQbre_zbRROTnddv1Vh09_9w3o3SR4",//新订单通知
            "url"=>$gourl,
            "topcolor"=>"#FF0000",
            "data"=>array(
                "first"=>array("value"=>$first1,"color"=>"#CD453B"),
                "keyword1"=>array("value"=>$sn,"color"=>"#2B9F65"),
                "keyword2"=>array("value"=>$method,"color"=>"#5785CF"),
                "keyword3"=>array("value"=>$phone,"color"=>"#D19B43"),
                "keyword4"=>array("value"=>$total_price,"color"=>"#743A3A"),
                "keyword5"=>array("value"=>date("Y-m-d H:i:s",time()),"color"=>"#743A3A"),
                "remark"=>array("value"=>$remark1,"color"=>"#008000")
            )
        );
        $data = json_encode($content);
        return  $access_token.self::do_post_request($url, $data);
    }


   /**
     * {{first.DATA}} 
     * 账户：{{account.DATA}}
     * 时间：{{time.DATA}}
     * 类型：{{type.DATA}}  
     * {{remark.DATA}}
     *{{remark.DATA}}
     * @param $openId
     * @param $first
     * @param $gourl
     * @param $realname
     * @param $time
     * @param $rank
     * @param $remark
     * @return string
     * author Fox
     */
    public static function AccountMessage($openId,$gourl,$first,$realname,$time,$rank,$remark)
    {
        $access_token_2=new JSSDK();
        $access_token=$access_token_2->getAccessToken();
        $url  = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $content=array(
            "touser"=>$openId,
//            "touser"=>"oozXjwOYTO6HDC1GKpKGQFuQ-R-U",
            "template_id"=>"Y2e2B_TV0IZ9pOKkLINZHy7fList5PWTseMJhMsgLb0",//账户变更提醒
            "url"=>$gourl,
            "topcolor"=>"#FF0000",
            "data"=>array(
                "first"=>array("value"=>$first,"color"=>"#CD453B"),
                "account"=>array("value"=>$realname,"color"=>"#2B9F65"),
                "time"=>array("value"=>$time,"color"=>"#5785CF"),
                "type"=>array("value"=>$rank,"color"=>"#D19B43"),
                "remark"=>array("value"=>$remark,"color"=>"#008000")
            )
        );
        $data = json_encode($content);
        return  $access_token.self::do_post_request($url, $data);
    }
    
      /**
     * {{first.DATA}}
     * 订单编号: {{OrderSn.DATA}}
     * 订单状态: {{OrderStatus.DATA}}
     * {{remark.DATA}}
     * @param type $openId
     * @param type $first
     * @param type $gourl
     * @param type $sn
     * @param type $status
     * @param type $remarks
     * @return type
     */
    public static function OrderupdateMessage($openId,$first,$gourl,$sn,$status,$remarks)
    {
        $access_token_2=new JSSDK();
        $access_token=$access_token_2->getAccessToken();
        $url  = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $content=array(
            "touser"=>$openId,
            "template_id"=>"5_PrdecryyplOUxHCeVH80QrlyaEBSAemz75Eha7DnI",//订单状态更新
            "url"=>$gourl,
            "topcolor"=>"#FF0000",
            "data"=>array(
                "first"=>array("value"=>$first,"color"=>"#CD453B"),
                "OrderSn"=>array("value"=>$sn,"color"=>"#2B9F65"),
                "OrderStatus"=>array("value"=>$status,"color"=>"#5785CF"),
                "remark"=>array("value"=>$remarks,"color"=>"#008000")
            )
        );
        $data = json_encode($content);
        return  $access_token.self::do_post_request($url, $data);
    }
	
	
     public static function zctxMessage($openId,$gourl,$first,$realname,$phone,$time,$remark)
    {
        $access_token_2=new JSSDK();
        $access_token=$access_token_2->getAccessToken();
        $url  = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$access_token";
        $content=array(
            "touser"=>$openId,
//            "touser"=>"oozXjwOYTO6HDC1GKpKGQFuQ-R-U",
            "template_id"=>"MTGU11-uzXQiT99_JvU9y7ye1wUpUTBlH4PYRZ_SrKQ",//注册提醒
            "url"=>$gourl,
            "topcolor"=>"#FF0000",
            "data"=>array(
                "first"=>array("value"=>$first,"color"=>"#CD453B"),
                "keyword1"=>array("value"=>$realname,"color"=>"#2B9F65"),
                "keyword2"=>array("value"=>$phone,"color"=>"#5785CF"),
                "keyword3"=>array("value"=>$time,"color"=>"#D19B43"),
                "remark"=>array("value"=>$remark,"color"=>"#008000")
            )
        );
        $data = json_encode($content);
        return  $access_token.self::do_post_request($url, $data);
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

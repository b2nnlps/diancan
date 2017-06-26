<?php
namespace common\wechat;


class WechatAuth
{
    private $options;
    public $open_id;
    public $wxuser;

    public function __construct($options){
        $this->options = $options;
        $this->wxoauth();
        session_start();
        //用$_SESION之前必须要session_start()----其中之一的功能,$_SESSION是服务器端的cookie，
        //相当一个大数组(浏览器关闭前，和session销毁前)$_SESSION中的数据可以一直用(除了重新赋值)。
        //$_SESSION 好比一个数组 $_SESSION['name'] = 'xinming' 这好比在数组中加了一个元素，
        //相当于$_SESSION = array("name"=>"xinming") 使用的时候 还要使用$_SESSION['name'] 才能得到'caocao'。

    }

    public function wxoauth(){
        $scope = 'snsapi_base';
        $code = isset($_GET['code'])?$_GET['code']:'';
        $token_time = isset($_SESSION['token_time'])?$_SESSION['token_time']:0;
        if(!$code && isset($_SESSION['open_id']) && isset($_SESSION['user_token']) && $token_time>time()-3600)
        {
            if (!$this->wxuser) {
                $this->wxuser = $_SESSION['wxuser'];
            }
            $this->open_id = $_SESSION['open_id'];
            return $this->open_id;
        }
        else{
            $options = array(
                'token'=>$this->options["token"], //填写你设定的key
                'appid'=>$this->options["appid"], //填写高级调用功能的app id
                'appsecret'=>$this->options["appsecret"] //填写高级调用功能的密钥
            );
            $we_obj = new Wechat($options);
            if ($code) {
                $json = $we_obj->getOauthAccessToken();
                if (!$json) {
                    unset($_SESSION['wx_redirect']);
                    die('获取用户授权失败，请重新确认');
                }
                $_SESSION['open_id'] = $this->open_id = $json["openid"];
                $access_token = $json['access_token'];
                $_SESSION['user_token'] = $access_token;
                $_SESSION['token_time'] = time();

                $userinfo = $we_obj->getUserInfos($this->open_id);
                if ($userinfo && !empty($userinfo['nickname'])) {
                    $this->wxuser = array(
                        'open_id'=>$this->open_id,
                        'nickname'=>$userinfo['nickname'],
                        'sex'=>intval($userinfo['sex']),
                        'location'=>$userinfo['province'].'-'.$userinfo['city'],
                        'avatar'=>$userinfo['headimgurl']
                    );
                } elseif (strstr($json['scope'],'snsapi_userinfo')!==false) {
                    $userinfo = $we_obj->getOauthUserinfo($access_token,$this->open_id);
                    if ($userinfo && !empty($userinfo['nickname'])) {
                        $this->wxuser = array(
                            'open_id'=>$this->open_id,
                            'nickname'=>$userinfo['nickname'],
                            'sex'=>intval($userinfo['sex']),
                            'location'=>$userinfo['province'].'-'.$userinfo['city'],
                            'avatar'=>$userinfo['headimgurl']
                        );
                    } else {
                        return $this->open_id;
                    }
                }
                if ($this->wxuser) {
                    $_SESSION['wxuser'] = $this->wxuser;
                    $_SESSION['open_id'] =  $json["openid"];
                    unset($_SESSION['wx_redirect']);
                    return $this->open_id;
                }
                $scope = 'snsapi_userinfo';
            }
            if ($scope=='snsapi_base') {
                $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                $_SESSION['wx_redirect'] = $url;
            } else {
                $url = $_SESSION['wx_redirect'];
            }
            if (!$url) {
                unset($_SESSION['wx_redirect']);
                die('获取用户授权失败');
            }
            $oauth_url = $we_obj->getOauthRedirect($url,"wxbase",$scope);
            header('Location: ' . $oauth_url);
        }
    }
}

/**
 * 使用方法
 *
 */
//$options = array(
//    'token'=>'tokenaccesskey', //填写你设定的key
//    'appid'=>'wxdk1234567890', //填写高级调用功能的app id, 请在微信开发模式后台查询
//    'appsecret'=>'xxxxxxxxxxxxxxxxxxx', //填写高级调用功能的密钥
//);
//$auth = new WechatAuth($options);
//var_dump($auth->wxuser);

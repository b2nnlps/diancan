<?php
namespace frontend\controllers;

use backend\modules\merchant\models\Member;
use backend\modules\sys\models\WechatUser;
use common\wechat\Wechat;
use Yii;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;



/**
 * Site controller
 */
class BaseController extends Controller
{
//    public $layout='main';
    public $isWxBrowser = false;
    public $openid=null;
	public $rh_openid=null;
    public $wx_openid=null;
    /**
     * @inheritdoc
     */

    public static function encode($a,$b,$check=false){//a,b为必须要加密的，check为检验，如果传入则检查是否和ab加密后一致
        if($check){
            $str=md5($a.'neil'.$b).md5(md5($a.$b)).'*';
            if($str==$check) return true; else return false;
        }else{
            $str=md5($a.'neil'.$b).md5(md5($a.$b)).'*';
            return $str;
        }
    }

    public static function isGuest(){//是否登录
        if(isset($_COOKIE['wechat'])){
            if(isset($_COOKIE[$_COOKIE['wechat'].'_openid']) && isset($_COOKIE[$_COOKIE['wechat'].'_hash'])){
                if(self::encode($_COOKIE['wechat'],$_COOKIE[$_COOKIE['wechat'].'_openid'],$_COOKIE[$_COOKIE['wechat'].'_hash'])){
                    return false;
                }
            }
        }
        return true;
    }

    public function beforeAction($action)
    {
        if(Yii::$app->controller->action->id != 'error'){
            $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
            if(strpos($agent,"micromessenger")) {
                $this->isWxBrowser =true;
            }else{
                throw new BadRequestHttpException("只能在微信客户端访问");
            }
        }


        if($this->isWxBrowser && self::isGuest() && Yii::$app->controller->action->id != 'auth-redirect'){

            $gzh=isset($_COOKIE['wechat'])?$_COOKIE['wechat']:'wechat_msjlb';//设置默认使用的公众号信息

            $params = Yii::$app->params[$gzh];
            $wechat = new Wechat($params);

            $redirect = Yii::$app->urlManager->createAbsoluteUrl(['base/auth-redirect']).'?URL='.($_SERVER['REQUEST_URI']);

            $url = $wechat->getOauthRedirect($redirect);
			 
            header("location:$url");
            exit;
        }

        $this->openid=$_COOKIE[$_COOKIE['wechat'].'_openid'];
		$this->openid=$_COOKIE[$_COOKIE['wechat'].'_openid'];
        $wx_openid=$_COOKIE[$_COOKIE['wechat'].'_openid'];
        $member=Member::find()->where(['wx_openid'=>$wx_openid])->one();
        if(!empty($member)){
            $this->rh_openid=$member['rh_openid'];
        }
        $this->wx_openid=$wx_openid;
        return parent::beforeAction($action);
    }

       

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => 'error',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'minLength' => 3,
                'maxLength' => 5,
            ],
        ];
    }

    /**
     * 微信授权入口
     *
     */
    public function actionAuthRedirect()
    {
        $gzh=isset($_COOKIE['wechat'])?$_COOKIE['wechat']:'wechat_msjlb';
        $params = Yii::$app->params[$gzh];
        $wechat = new Wechat($params);
        $data = $wechat->getOauthAccessToken();

        if($data && $data['openid']) {
            $wxuser=WechatUser::findOne($data['openid']);//查找微信用户表中是否有该用户
            $wechatUser = $wechat->getOauthUserinfo($data['access_token'],$data['openid']);
            $nickname =$wechatUser['nickname'];
            //解决接口获取微信昵称存在乱码
            $nickname1 = preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '', $nickname);
			$time=time();//当前时间戳
            if(empty($wxuser)){
                $wxuser = new WechatUser();
//                $wxuser->id=uniqid().rand(1000,9999);
                $wxuser->openid =$wechatUser['openid'];
                $wxuser->status=0;
                $wxuser->module=1;//所属模块微信用户，1：通用
				$wxuser->auth_time=$time;
				$wxuser->wechat=$gzh;
                
				
            }
            if(isset($nickname1))
            {
                $wxuser->nickname =$nickname1;
            }
            if(isset($wechatUser['headimgurl']))
            {
                $wxuser->headimgurl =$wechatUser['headimgurl'];
            }
            $wxuser->sex =$wechatUser['sex'];
            $country=$wechatUser['country'];
            $province=$wechatUser['province'];
            $city=$wechatUser['city'];
            $wxuser->address=$country.'-'.$province.'-'.$city;
          
            $wxuser->updated_time=date("Y-m-d H:i:s",$time);//日期时间格式化

            $wxuser->save();

            setcookie('wechat',$gzh,time()+86400,'/');
            setcookie($gzh.'_openid',$data['openid'],time()+86400,'/');
            setcookie($gzh.'_hash',self::encode($gzh,$data['openid']),time()+86400,'/');

        }
        $url = Yii::$app->request->get('URL','');
        $url = $url ? $url : '/';
		
        $this->redirect([$url]);
        $url1 = Yii::$app->request->get('URL','');
    }



}

<?php
namespace frontend\modules\eshop\controllers;

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
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::$app->view->params['keywords'] = '';
        Yii::$app->view->params['description'] = '';
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


        if($this->isWxBrowser &&!isset($_COOKIE['msjlb_openid']) && Yii::$app->controller->action->id != 'auth-redirect'){
            $params = Yii::$app->params['wechat_msjlb'];
            $wechat = new Wechat($params);

            $redirect = Yii::$app->urlManager->createAbsoluteUrl(['eshop/good/auth-redirect']).'?URL='.($_SERVER['REQUEST_URI']);

            $url = $wechat->getOauthRedirect($redirect);
			 
            header("location:$url");
            exit;
        }
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
        $params = Yii::$app->params['wechat_msjlb'];
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

            

//           Yii::$app->user->login($wxuser, 3600 * 24);
          //  setcookie('openId',$wxuser->openid,time()+3600*6,'/');
           setcookie('msjlb_openid',$wxuser->openid,time()+3600*1,'/');
        }
        $url = Yii::$app->request->get('URL','');
        $url = $url ? $url : '/';
        $this->redirect([$url]);
        $url1 = Yii::$app->request->get('URL','');
    }



}

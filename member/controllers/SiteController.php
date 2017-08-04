<?php
namespace member\controllers;

use member\modules\food\models\Order;
use member\modules\sys\models\Loginlog;
use member\modules\sys\models\User;
use common\components\Mobile_Detect;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\UploadedFile;
use yii\web\Response;
use member\modules\food\models\Food;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
					[
                        'actions' => ['login','captcha'],
                        'allow' => true,
                        'roles' => ['?']
                    ],//没这个验证码不显示
                    [
                        'actions' => ['logout', 'index','change-password','upload','profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'height' => 35,
                'width' => 100,
                'minLength' => 5,
                'maxLength' => 4
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $todayStart = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $todayEnd = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $yesterdayStart = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
        $yesterdayEnd = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 1;
        $lastWeekStart = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1 - 7, date('Y'));
        $lastWeekEnd = mktime(23, 59, 59, date('m'), date('d') - date('w') + 7 - 7, date('Y'));
        $thisWeekStart = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1, date('Y'));
        $thisWeekEnd = mktime(23, 59, 59, date('m'), date('d') - date('w') + 7, date('Y'));
        $lastMonthStart = mktime(0, 0, 0, date('m') -1, 1, date('Y'));
        $lastMonthEnd = mktime(0, 0, 0, date('m'), 1, date('Y')) - 1;
        $thisMonthStart = mktime(0, 0, 0, date('m'), 1, date('Y'));
        $thisMonthEnd = mktime(0, 0, 0, date('m') + 1, 1, date('Y')) - 1;
        $lastYearStart = mktime(0, 0, 0, 1,1, date('Y')-1);//去年开始
        $lastYearEnd = mktime(0, 0, 0, 1,1,date('Y'))-1;//去年结束
        $thisYearStart = mktime(0, 0, 0, 1,1, date('Y'));//今年开始
        $thisYearEnd = mktime(0, 0, 0, 1,1,date('Y')+1) - 1;//今年结束
        $query = new \yii\db\Query();
        // User Stat
        $u_id=Yii::$app->user->identity->id;
        $result = $query->select('count(*) as count')->from('t_sys_loginlog')->where(['and',['u_id' =>$u_id],['and', 'login_time > ' . $todayStart . '', 'login_time <= ' . $todayEnd]])->createCommand()->queryOne();
        $dataUser['todayCount'] = $result['count'];

        $result = $query->select('count(*) as count')->from('t_sys_loginlog')->where(['and',['u_id' =>$u_id],['and', 'login_time > ' . $yesterdayStart . '', 'login_time <= ' . $yesterdayEnd]])->createCommand()->queryOne();
        $dataUser['yesterdayCount'] = $result['count'];

        $result = $query->select('count(*) as count')->from('t_sys_loginlog')->where(['and',['u_id' =>$u_id],['and', 'login_time > ' . $lastWeekStart . '', 'login_time <= ' . $lastWeekEnd]])->createCommand()->queryOne();
        $dataUser['lastWeekCount'] = $result['count'];

        $result = $query->select('count(*) as count')->from('t_sys_loginlog')->where(['and',['u_id' =>$u_id],['and', 'login_time > ' . $thisWeekStart . '', 'login_time <= ' . $thisWeekEnd]])->createCommand()->queryOne();
        $dataUser['thisWeekCount'] = $result['count'];

        $result = $query->select('count(*) as count')->from('t_sys_loginlog')->where(['and',['u_id' =>$u_id],['and', 'login_time > ' . $lastMonthStart . '', 'login_time <= ' . $lastMonthEnd]])->createCommand()->queryOne();
        $dataUser['lastMonthCount'] = $result['count'];

        $result = $query->select('count(*) as count')->from('t_sys_loginlog')->where(['and',['u_id' =>$u_id],['and', 'login_time > ' . $thisMonthStart . '', 'login_time <= ' . $thisMonthEnd]])->createCommand()->queryOne();
        $dataUser['thisMonthCount'] = $result['count'];

        $result = $query->select('count(*) as count')->from('t_sys_loginlog')->where(['and',['u_id' =>$u_id],['and', 'login_time > ' . $lastYearStart . '', 'login_time <= ' . $lastYearEnd]])->createCommand()->queryOne();
        $dataUser['lastYearCount'] = $result['count'];

        $result = $query->select('count(*) as count')->from('t_sys_loginlog')->where(['and',['u_id' =>$u_id],['and', 'login_time > ' . $thisYearStart . '', 'login_time <= ' . $thisYearEnd]])->createCommand()->queryOne();
        $dataUser['thisYearCount'] = $result['count'];

        $login_log=Loginlog::find()->where(['u_id' =>$u_id])->limit(5)->asArray()->orderBy('id desc')->all();
        $order = Order::find()->asArray()->limit(10)->orderBy('id desc')->all();
        return $this->render('index',[
            'login_log'=>$login_log,
            'dataUser' => $dataUser,
            'order' => $order,
        ] );
    }

    /**
     * 个人资料
     * @return string
     */
    public function actionProfile()
    {
        return $this->render('profile');
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $login_log=new Loginlog();
            $login_log->u_id=Yii::$app->user->id;
            $login_log->login_time=time();//当前日期时间转化为时间戳
            $login_ip=Yii::$app->request->userIP;
            $login_log->login_ip=$login_ip;

  //          $data=getiploc_taobao('112.66.247.91');
          //  $data=getiploc_taobao($login_ip);
        //    $login_log->login_address= $data['country'].$data['area'].'-'.$data['region'].$data['city'].$data['county'].'--'.$data['isp'];

//             $login_log->login_address= getiploc_sina($login_ip);
//            $login_log->login_address= getiploc_sina("112.66.247.91");

            $detect = new Mobile_Detect();
            $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');//获取登录设备类型是平板（tablet），手机（'phone'），还是电脑（computer）
            $system_browser=htmlentities($_SERVER['HTTP_USER_AGENT']);//获取登录设备的系统类型和浏览器信息
            $login_log->login_equipment=$deviceType.','.$system_browser;
            if( $login_log->save()){
                return $this->goBack();
            }
        } else {
            return $this->render('login', [

                'model' => $model,
            ]);
        }
    }
    /**
     * 修改密码
     * @return type
     */
    public function actionChangePassword()
    {
        $model = new User(['scenario' => 'admin-change-password']);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::findOne(Yii::$app->user->identity->id);
            $user->setPassword($model->password);
            $user->generateAuthKey();
            if ($user->save()) {
                Yii::$app->getSession()->setFlash('success','修改为新密码成功');
            }
            return $this->redirect(['change-password']);
        }

        return $this->render('changePassword', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result=[
            'status'=>0
        ];
        if(Yii::$app->request->isPost){
            Yii::error($_REQUEST['dir']);
            Yii::error($_REQUEST['width']);
            $type = Yii::$app->request->get('type');
            if($type == 'input'){
                $webroot = Yii::getAlias('@webroot');
                $name = '';
                foreach($_FILES as $key=>$item){
                    $name = $key;
                    break;
                }
                $dir = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 'catering';
//                $width = isset($_REQUEST['width']) ? $_REQUEST['width'] : 500;
//                $height = isset($_REQUEST['height']) ? $_REQUEST['height'] :null;
                $file = UploadedFile::getInstanceByName($name);
                $dir ='/'. $dir.date('/Y/m/d');
                if (!file_exists($webroot.$dir)){
                    self::makeDir($webroot.$dir);
                }

                $timename=time().mt_rand(100,999) ;
                $name =$dir.'/' . $timename . '.' . $file->extension;
                $name_thumb=$dir.'/' . $timename . '_thumb.' . $file->extension;
                $file->saveAs($webroot.$name);
                \common\components\functional\ImageUtility::thumbs($webroot.$name,$webroot.$name_thumb,100,100);//创建缩略图
                $b=1;
                $name=str_replace("/upload/","",$name,$b);
                $url ='http://foodimg.n39.cn/'.$name;

                $b=1;
                $name_thumb=str_replace("/upload/","",$name_thumb,$b);
                $url_thumb ='http://foodimg.n39.cn/'.$name_thumb;
                $result = [
                    'jsonrpc'=>'2.0',
                    'status'=>1,
                    'result'=>$url,
                    'thumb'=>$url_thumb,
                    'id'=>$url,
                    'url'=>$url
                ];
            }
        }
        return $result;
    }
    public static function makeDir($dir)
    {
        if (!is_dir($dir)) {
            if (!is_dir(dirname($dir))) {
                self::makeDir(dirname($dir));
                mkdir($dir, 0777);
            } else {
                mkdir($dir, 0777);
            }
        }
    }

}
/**
 * php利用淘宝获取ip地理位置
 * 淘宝IP接口
 * @Return: array
 */
function getiploc_taobao($ip)
{
    $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
    $ips=json_decode(file_get_contents($url));
    if((string)$ips->code=='1'){
        return false;
    }
    $data = (array)$ips->data;
    return $data;
}

//$data=getiploc_taobao('223.199.220.99');
// var_dump($data);
//echo  $data['country'].$data['area'].'-'.$data['region'].$data['city'].$data['county'].'-运营商：中国'.$data['isp'];



/**
 * php利用腾讯ip分享计划获取ip地理位置
 * @param type $queryip
 * @return type
 */
function getiploc_qq($queryip)
{
    $url = 'http://ip.qq.com/cgi-bin/searchip?searchip1='.$queryip;
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_ENCODING ,'gb2312');
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
    $result1 = curl_exec($ch);
    $result = mb_convert_encoding($result1, "utf-8", "gb2312"); // 编码转换，否则乱码
    curl_close($ch);
    preg_match("@<span>(.*)</span></p>@iu",$result,$iparray);
    $loc = $iparray[1];
    return $loc;
}
// echo getiploc_qq("223.199.220.99"); //即可得到ip地址所在的地址位置

/**
 * php利用新浪ip查询接口获取ip地理位置
 */
function getiploc_sina($queryip){
    $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryip;
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_ENCODING ,'utf8');
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
    $location1 = curl_exec($ch);
    $location = json_decode($location1);
    curl_close($ch);
    $loc = "";
    if($location===false) return "";
    if (empty($location->desc)) {
        $loc = $location->province.$location->city.$location->district.$location->isp;
    }else{
        $loc = $location->desc;
    }
    return $loc;
}
//echo getiploc_sina("223.199.220.99");
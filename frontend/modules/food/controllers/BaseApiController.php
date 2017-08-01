<?php
namespace frontend\modules\food\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use yii\web\HttpException;
use member\modules\food\models\ShopStaff;

class BaseApiController extends Controller
{
    public $shopId=1;
    public $staff;

    /**
     * 所有动作执行之前获取用户信息
     *
     * @param  action
     * @return function
     */
    public function beforeAction($action)
    {
        if (isset($_SERVER["HTTP_REFERER"])) {
            $url       = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
            $str   = str_replace("http://", "", $url);  //去掉http://
            $strdomain = explode("/", $str);               // 以“/”分开成数组
            $domain    = $strdomain[0];              //取第一个“/”以前的字符
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: http://".$domain);
            header("Access-Control-Allow-Headers: content-type");
        } else {
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: content-type");
        }

        return parent::beforeAction($action);
    }

    public function isLogin(){
        $username=Yii::$app->request->get('username','');
        $hash=Yii::$app->request->get('hash','');//获取传过来的密文
        $staff=ShopStaff::findOne(['username'=>$username]);//查找数据库看看有无对应
        if($staff){
            $this->shopId=$staff['shop_id'];
            $this->staff=$staff;
            $hash_2=md5($staff['username'].'llrj'.$staff['password']);
            if($hash==$hash_2) return true;//验证成功
        }
        return $this->errorResponse([], -100, "未登录");
}

    /**
     * 正确返回
     *
     * @param  array  $data    返回数据
     * @param  string $message 返回消息
     * @return array
     */
    public function response($data, $message = "SUCCESS")
    {
        $return=array(
            "code" => 0,
            "data" => $data,
            "error" => array(),
            "message" => $message
        );

        if (isset($_GET['callback'])) {
            $response=Yii::$app->response;
            $response->format=Response::FORMAT_JSON;
            $response->data=$return;
            echo $_GET['callback'].'('.json_encode($return).')';
            die;
        }

        return $return;
    }

    /**
     * 错误返回
     *
     * @param  error
     * @param  message
     * @return array
     */
    public function errorResponse($error, $code, $message = "FAILED")
    {
        $return=array(
            "code" => $code,
            "data" => array(),
            "error" => $error,
            "message" => $message
        );

        if (isset($_GET['callback'])) {
            $response=Yii::$app->response;
            $response->format=Response::FORMAT_JSON;
            $response->data=$return;
            echo $_GET['callback'].'('.json_encode($return).')';
            die;
        }
        throw new HttpException(200, json_encode($return), $code);//抛出异常强制退出，return会返回到子程序
    }
}

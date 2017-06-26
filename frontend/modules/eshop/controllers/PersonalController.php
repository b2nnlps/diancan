<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-23
 * Time: 17:15
 */
namespace frontend\modules\eshop\controllers;


use backend\modules\sys\models\Address;
use backend\modules\sys\models\Member;
use backend\modules\sys\models\Verification;
use yii\web\Controller;
use Yii;
use backend\modules\sys\models\WechatUser;
use common\wechat\JSSDK;
use common\wechat\Wechat;
use common\wechat\PushMessage;
use frontend\controllers\BaseController;

//class PersonalController extends Controller
class PersonalController extends BaseController
{
  /**
     * 个人中心
     * @return string
     */
    public function actionIndex(){
         $user_id=$this->openid;
        // $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $member=Member::findOne($user_id);
        $rank=$member->rank;
        return $this->render('index',[
            'user_id'=>$user_id,
            'member'=>$member,
            'rank'=>$rank,
        ]);
    }

 /**
     * 收货地址
     * @return string
     */
    public function actionAddress(){
        $user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
		 $member=Member::findOne($user_id);//查询用户详情
        if(!empty($member)){
			$address=Address::find()->where(['user_id'=>$user_id])->all();
			return $this->render('address',[
				'address'=>$address,
			]);
		 }else{
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/add']));
        }
    }
	/**
     * 新增地址
     * @return string
     */
    public function actionAddRegion(){
		 $user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
		 $member=Member::findOne($user_id);//查询用户详情
        if(!empty($member)){
	//        $district=District::find()->where(['type'=>'state'])->all();
	//        $model=new Address();
			return $this->render('add-region',[
	//            'district'=>$district,
	//            'model'=>$model,
			]);
		 }else{
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/add']));
        }
    }
	
	/**
     * 更新地址信息
     * @param $id
     * @return string
     */
    public function actionUpdateRegion($id){
        $model=Address::findOne($id);
        return $this->render('update-region',[
            'model'=>$model,
        ]);
    }
	 /**
     * 保存地址信息
     */
    public function actionSaveRegion(){
		$user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $consignee= Yii::$app->request->post('consignee');

        $phone= Yii::$app->request->post('phone');
        $defaults= Yii::$app->request->post('defaults');
//        $provinvce= Yii::$app->request->post('provinvce');
//        $city= Yii::$app->request->post('city');
//        $district= Yii::$app->request->post('district');
        $address= Yii::$app->request->post('address');
        $zipcode = Yii::$app->request->post('zipcode');

        if ($consignee && $phone && $defaults  && $address) {
            $id = Yii::$app->request->post('id');
            if($id){
                $model=Address::findOne($id);
            }else{
                $model=new Address();
            }
            $model->user_id=$user_id;
            $model->consignee=$consignee;
            $model->phone=$phone;
//            $model->provinvce=$provinvce;
//            $model->city=$city;
//            $model->district=$district;
            $model->address=$address;
            $model->zipcode=$zipcode;
            $model->default=$defaults;
            $model->status=1;
            if($model->save()){
                if($model->default==10){
                    $addressModel=Address::find()->where(['and',['user_id'=>$user_id],['!=','id',$model->id],['default'=>10]])->all();
                    foreach ($addressModel as $_v){
                        $_v->default=1;
                        $_v->save();
                    }
                }
            }
        }
    }

	/**
     * 推广二维码
     * @return string|\yii\web\Response
     */
//public function actionPopularize(){
//        //        $user_id=$this->openid;
//        $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
//        $member=Member::findOne($user_id);//查询用户详情
//        if(!empty($member)){
//            $wxUser=WechatUser::findOne($user_id);//查询微信用户信息
//            if($member['ticket']==''||$member['ticket']==null){//查找数据库中是否有该二维码
//                $scene_id="eshop,".$user_id;
//                $params = Yii::$app->params['wechat_msjlb'];
//                $wechat = new Wechat($params);
//
//                $access_token_2=new JSSDK();
//                $access_token=$access_token_2->getAccessToken();
////                var_dump($access_token);
////                exit;
//                $QRCode=$wechat->getQRCode($scene_id,$type=1,$expire=2592000,$access_token);//微信创建永久二维码ticket
//                $ticket=$QRCode['ticket'];//创建二维码ticket
////                $QRUrl=$wechat->getQRUrl($ticket);//获取二维码图片地址
////                $member->ticket=$QRUrl;
//                $member->ticket=$ticket;
//                $member->save();
//            }
//            $QRImg=$member['ticket'];
//            return $this->render('popularize',[
//                    'user_id'=>$user_id,
//                    'QRImg'=>$QRImg,
//                ]
//            );
//        }else{
//            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['eshop/personal/add']));
//        }
//    }
    
    /**
     * 个人资料
     * @return string
     */
    public function actionDetails(){
         $user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $member=Member::findOne($user_id);
        return $this->render('details',[
            'member'=>$member,
        ]);
    }
	/**
     * 注册会员
     * @return string
     */
    public function actionAdd(){
         $user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        return $this->render('add',[
            'user_id'=>$user_id,
        ]);
    }
    /**
     * 点击获取验证码
     * @return string
     * author Fox
     */
    public function actionVerifycode() {
        $phone=$_POST['phone'];//注册手机号码
        if(preg_match("/(1[3-9]\d{9}$)/",$phone)){
            $member=Member::find()->where(['phone'=>$phone])->count();
            if($member==0){
                $verifycode=rand(1000,9999);//生成随机验证码
                $time=time();//当前时间戳
                $verifyModel=Verification::find()->where(['phone'=>$phone])->one();
                $datetime=$verifyModel['time'];
                if(count($verifyModel)!=0){//该用户是否已经生成验证码
                    $verifyTime=strtotime($verifyModel['time'])+240;
                    if($time>=$verifyTime){//生成验证码是否已经超过2分钟
                        $verifyModel->code=$verifycode;
                        $verifyModel->phone=$phone;
                        $verifyModel->status=1;
                        $verifyModel->totalclick=$verifyModel['totalclick']+1;
                        $verifyModel->time=date("Y.m.d H:i:s",$time);//日期时间格式化
                        $verifyModel->remarks="注册验证码";

                        $click=$verifyModel['click'];
                        $date=date('Y-m-d');//当前日期
                        $verifyDate=date("Y-m-d",strtotime($datetime));//验证码生成日期
                        if($date==$verifyDate){
                            if($click<5){
                                $verifyModel->click=$click+1;
                                if($verifyModel->save()){
                                    Verification::send($verifycode,$phone);
                                    $strResult= '获取验证码成功！2分钟内将收到验证码！';//成功提示
                                }else{
                                    $strResult='获取验证码失败，请2分钟后重新点击获取！';
                                }
                            }else{
                                $strResult='获取验证码失败，您今天获取验证码已超过5次，请明天再来！';
                            }
                        }else{
                            $verifyModel->click=1;
                            if($verifyModel->save()){
                                Verification::send($verifycode,$phone);
                                $strResult= '获取验证码成功！2分钟内将收到验证码！';//成功提示
                            }else{
                                $strResult='获取验证码失败，请2分钟后重新点击获取！';
                            }
                        }
                    }else{
                        $strResult='获取验证码失败，请2分钟后重新点击获取！';
                    }
                }else{
                    $model=new Verification();
                    $model->code=$verifycode;
                    $model->phone=$phone;
                    $model->status=1;
                    $model->click=1;
                    $model->totalclick=1;
                    $model->time=date("Y.m.d H:i:s",$time);//日期时间格式化
                    $model->remarks="注册验证码";
                    if($model->save()){
                        Verification::send($verifycode,$phone);
                        $strResult= '获取验证码成功！2分钟内将收到验证码！';//成功提示
                    }else{
                        $strResult="获取验证码失败，请2分钟后重新点击获取666！";
                    }
                }
            }else{
                $strResult= '该手机号码已被注册！';
            }
        }else{
            $strResult= '手机号码格式错误！';
        }
        return $strResult;
    }
    /**
     * 用户注册信息保存
     * @return string
     * author Fox
     */
    public function actionRegister(){
        if(isset($_POST['realname'])&&isset($_POST['phone'])&&isset($_POST['code'])&&isset($_POST['address'])&&isset($_POST['yq'])){
            $name=preg_replace("/\s/","",$_POST['realname']);//php去掉字符串中的所有空格
            $nameLen=strlen($name);//获取字符串长度：一个汉字长度为2；一个字母,标点符号或数字分别为1
            $address=preg_replace("/\s/","",$_POST['address']);
            $addressLen=strlen($address);
            
            $yq=$_POST['yq'];

            $phone=$_POST['phone'];
            $v_code=$_POST['code'];//传过来的验证码
            $verifyCode=preg_replace("/\s/","",$v_code);
            $codeLen=strlen($verifyCode);
            $address = Yii::$app->request->post('address');
            if($nameLen>40||$nameLen<3){//用户名不能超过20个字符
                $strResult="用户名不能少于2个或超过20个字符！";
            }elseif (!preg_match("/(1[3-9]\d{9}$)/",$phone)) {
                $strResult="手机号码格式错误！";
            }elseif (!preg_match("/(1[3-9]\d{9}$)/",$yq)) {
                $strResult="店家手机号码格式错误！";
            }else if($addressLen>250||$addressLen<4){
                $strResult="联系地址不能少于2个或超过250个字符！";
            }elseif (!is_numeric($verifyCode)||$codeLen!=4) {
                $strResult="验证码必须是4位数字！";
            } else {
                $phoneCount=Member::find()->where(['phone'=>$phone])->count();
                $vecode=Verification::find()->where(['phone'=>$phone])->one();
                if($phoneCount!=0){
                    $strResult="该手机号码已被注册！";
                }elseif (count($vecode)==0) {
                    $strResult="您还没生成验证码呢！";
                }else {
                    $mb=Member::find()->where(['phone'=>$yq])->one();
                    if(!empty($mb)){
                         $mb_rank=$mb->rank;
                        if($mb_rank==1){
                            $strResult="商家手机号无效！";
                        }else{
                            $sceneId=$mb['openid'];
                            $code=$vecode['code'];
                            $time=time();//当前时间戳
                            $codeTime=strtotime($vecode['time'])+240;
                            if($time>=$codeTime){//短信验证码生成时间是否小于2分钟
                                $strResult="该验证码已失效，请2分钟后重新点击获取验证码！";
                            }elseif ($verifyCode!=$code){//用户输入的验证码是否等于生成的验证码
                                $strResult="验证码错误，请重新输入！";
                            }  else {
								 $user_id=$this->openid;
								 //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
								$member=Member::findOne($user_id);
								if(empty($member)){//是否有该记录
									$member=new Member();//家人信息
									$member->openid=$user_id;
									$member->realname=$name;
									$member->phone=$phone;
									$member->address=$address;
									$member->status=1;
									$member->rank=1;
									$member->referrer=$sceneId;
									if($member->save()){
										$address1=Address::find()->where(['user_id'=>$user_id])->count();
										if($address1==0){
											$model=new Address();
											$model->user_id=$user_id;
											$model->consignee=$member->realname;
											$model->phone= $member->phone;
											$model->address= $member->address;
											$model->default=10;
											$model->status=1;
											$model->save();
										}
										  echo getPushMemberMessage($openid=$user_id, $name, $phone);
											WechatUser::getStatus($user_id);
									}
								}
                               // echo getUser($phone,$address,$name,$sceneId);
                                //$strResult='';
                            }
                        }
                    }else{
                        $strResult="没有相关店家！";
                    }
                }
            }
        }  else {
            $strResult="相关参数错误！";
        }
        return $strResult;
    }


}

/**
 * 将数据添加到数据库表
 * @param type $phone
 * @param type $address
 * @param type $name
 */
function getUser($phone,$address,$name,$sceneId){
     $user_id=$this->openid;
     //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
    $member=Member::findOne($user_id);
    if(empty($member)){//是否有该记录
        $member=new Member();//家人信息
        $member->openid=$user_id;
        $member->realname=$name;
        $member->phone=$phone;
        $member->address=$address;
        $member->status=1;
        $member->rank=1;
        $member->referrer=$sceneId;
        if($member->save()){
            $address1=Address::find()->where(['user_id'=>$user_id])->count();
            if($address1==0){
                $model=new Address();
                $model->user_id=$user_id;
                $model->consignee=$member->realname;
                $model->phone= $member->phone;
                $model->address= $member->address;
                $model->default=10;
                $model->status=1;
                $model->save();
            }
              echo getPushMemberMessage($openid=$user_id, $name, $phone);
			    WechatUser::getStatus($user_id);
        }
    }
}

/**
 * 注册会员通知
 * @param type $name
 * @param type $phone
 */
function getPushMemberMessage($openid,$name,$phone){
    $open_id=$openid.",oV1VUt6RUheAI-xfveukXdNW2ak8";
    $mess_push=explode(',',$open_id);
    $mess=array_unique($mess_push);
    $gourl="http://ms.n39.cn";
    $subtitle='您好!'.$name.'已成功注册成为美食俱乐部会员。';
    $account=$name.'【'.$phone.'】';
    $time=date("Y.m.d H:i:s",time());
    $rank='普通会员';
    $remark="如有任何问题请电话联系：0898-62922223,谢谢！";
    for($i=0;$i<count($mess);$i++){
        if(isset($mess[$i])){
            if($mess[$i]!=''){
                PushMessage::AccountMessage($mess[$i],$gourl,$subtitle,$account,$time,$rank,$remark);
            }}
    }
}
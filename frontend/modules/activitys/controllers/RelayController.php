<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\activitys\controllers;


use backend\modules\activitys\models\RelayActivity;
use backend\modules\activitys\models\RelayApplicant;
use backend\modules\activitys\models\RelayAwards;
use backend\modules\activitys\models\RelayPrize;
use backend\modules\activitys\models\RelayRecord;
use backend\modules\sys\models\Verification;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use frontend\controllers\BaseController;
/**
 * Description of RelayController
 *
 * @author Administrator
 */
class RelayController extends BaseController
//class RelayController extends Controller
{
	public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post','get'],
                ],
            ],
        ];
    }
      /**
     * 活动主页
     * @param string $openid
     * @return string
     */
     public function actionIndex($openid=''){
         $id=3;//活动ID
         $relayactivity=RelayActivity::findOne($id);
         if($relayactivity!=null){
             $wechat_openid=$this->openid;
       //      $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
             RelayActivity::updateAllCounters(['visit' => 1], ['id' => $id]);//浏览次数加1
             $applicants=RelayApplicant::find()->limit(50)->where(['activity_id'=>$id])->orderBy('point desc')->all();//查询出已报名的相对活动的报名信息
             $zrs_count=RelayApplicant::find()->where(['activity_id'=>$id])->count();//该活动总的参与人数
             $relayApplicant=RelayApplicant::find()->where(['activity_id'=>$id,'wechat_id'=>$openid])->one();
             $isApplicant=RelayApplicant::find()->where(['activity_id'=>$id,'wechat_id'=>$wechat_openid])->one();
         
             return $this->render('index',[
                 'relayactivity'=>$relayactivity,
                 'applicants'=>$applicants,
                 'zrs_count'=>$zrs_count,
                 'wechat_openid'=>$wechat_openid,
                 'relayApplicant'=>$relayApplicant,
                 'id'=>$id,
                 'isApplicant'=>$isApplicant,
             ] );
         }else{
             echo '该链接已失效！！';
         }
    }
    /**
     * 微助力报名信息保存
     * @return type
     */
    public function actionApplicants(){
         $wechat_openid=$this->openid;
        // $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $activity_id= Yii::$app->request->post('activity_id');
        $name= Yii::$app->request->post('name');
        $phone= Yii::$app->request->post('phone');
        if($activity_id&&$name&&$phone) {
			$activity=RelayActivity::findOne($activity_id);
            if($activity!=null){
				
				
				$now_time=strtotime(date('Y-m-d H:i:s')); //当前时间
                $start_time=strtotime($activity['start_time']); //活动开始时间
                $end_time=strtotime($activity['end_time']); //活动结束时间
                if($start_time>$now_time){//活动尚未开始
                    $strResult= '<em>活动尚未开始！</em>感谢您的参与！';
                }elseif ($end_time<$now_time){//活动已结束
                    $strResult= '<em>活动已结束！</em>感谢您的参与！';
                }else{
					
					$isbm = RelayApplicant::find()->where(['and', ['activity_id' => $activity_id, 'wechat_id' => $wechat_openid]])->count();//超找当前活动的当前用户是否已经报名
					 if ($isbm >= 1) {
						$strResult='您已经报过名，不能重复报名！';
					} else {
						$model = new RelayApplicant();
						$model->wechat_id = $wechat_openid;
						$model->activity_id = $activity_id;
						$model->name =$name;
						$model->mobilephone = $phone;
						$model->datetime = date('Y-m-d H:i:s');//当前日期时间格式化
						if ($model->save()) {
							RelayActivity::updateAllCounters(['willnum' => 1], ['id' => $activity_id]);//报名人数加1
							$strResult='';
						}
					}
					
                }
				
                
            }else{
                $strResult='报名失败，没有该活动！';
            }
           
        }
        return $strResult;
    }
	
	/**
     * @param $openid
     * @param $id
     * @return string
     */
    public function actionRecord($openid,$id=3){
        $RelayApplicant=RelayApplicant::find()->where(['wechat_id'=>$openid,'activity_id'=>$id])->one();
        $RalayRecord=RelayRecord::find()->where(['activity_id'=>$id,'to_user'=>$openid])->limit(100)->orderBy('id desc')->all();
         $RelayAwards=RelayAwards::find()->orderBy('id desc')->limit(100)->all();
        return $this->render('record',[
            'relayApplicant'=>$RelayApplicant,
            'relayRecord'=>$RalayRecord,
            'relayAwards'=>$RelayAwards,
        ]);

    }
    /**
     * 保存助力值
     * @return type
     */
    public function actionPointsave(){

         $wechat_openid=$this->openid;//谁投的票
        //  $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';

        $activity_id= Yii::$app->request->post('activity_id');//获取活动ID
        $to_user=Yii::$app->request->post('to_user');//投票给谁
        $date=date('Y-m-d');//投票时间
        
        $activity=RelayActivity::findOne($activity_id);//查询活动信息
        if($activity!=null){
            
            $now_time=strtotime(date('Y-m-d H:i:s')); //当前时间
            $start_time=strtotime($activity['start_time']); //活动开始时间
            $end_time=strtotime($activity['end_time']); //活动结束时间
            if($start_time>$now_time){//活动尚未开始
                $strResult= '<em>活动尚未开始！</em>感谢您的参与！';
            }elseif ($end_time<$now_time){//活动已结束
                $strResult= '<em>活动已结束！</em>感谢您的参与！';
            }else{
				
				
                $applicant_model=RelayApplicant::find()->where(['activity_id'=>$activity_id,'wechat_id'=>$to_user])->one();
                if($applicant_model!=null){
                    $type=$activity['type'];
                    if ($type==2){//判断投票类型：2代表每天可投一次票
                        $count_model=RelayRecord::find()->where(['and',['activity_id'=>$activity_id,'to_user'=>$to_user,'from_user'=>$wechat_openid,'date'=>$date]])->count();//统计投票记录中是否有该记录
                        if($count_model>=1){
                            $strResult= '<em>亲</em>，今天已经为该好友充过电了！请明天再来！';
                        }else {
                            $rand = mt_rand(1,20);//1-20的随机值
                            $model =new RelayRecord();//实例化投票记录
                            $model->activity_id=$activity_id;
                            $model->to_user=$to_user;
                            $model->from_user=$wechat_openid;
                            $model->point=$rand;
                            $model->date=$date;//投票时间
                            if($model->save()){
                                $point_model= RelayApplicant::find()->where(['and',['activity_id'=>$activity_id,'wechat_id'=>$to_user]])->one();//查找该报名者的相关信息
                                $point_model->point=$point_model->point+$rand;//报名者助力值增加
                                if($point_model->save()){
                                    $point_val=$point_model->point;//当前总的助力值
                                    $applicant_name=$point_model->name;//报名者姓名
                                    $applicant_phone=$point_model->mobilephone;//报名者电话

                                    if($point_val>100&&$point_val<150){//判断获奖阶段
                                        getCondition($pr_id=1,$to_user,$applicant_name,$applicant_phone,$point_val);
                                    }elseif ($point_val>300&&$point_val<350){
                                        getCondition($pr_id=2,$to_user,$applicant_name,$applicant_phone,$point_val);
                                    }elseif ($point_val>500&&$point_val<550){
                                        getCondition($pr_id=3,$to_user,$applicant_name,$applicant_phone,$point_val);
                                    }elseif ($point_val>800&&$point_val<850){
                                        getCondition($pr_id=4,$to_user,$applicant_name,$applicant_phone,$point_val);
                                    }elseif ($point_val>1000&&$point_val<1500){
                                        getCondition($pr_id=5,$to_user,$applicant_name,$applicant_phone,$point_val);
                                    }
									
									
                                }

                            }
                            $strResult='成功为好友助力<em>'.$rand.'</em>公里！';
                        }
                    }
                }else{
                    $strResult='助力失败，没有该好友！';
                }
                
            }
              
        }else{
            $strResult='助力失败，没有该活动！';
        }
        
        return $strResult;
    }
}
/**
 * 获奖信息
 * @param $pr_id
 * @param $to_user
 * @param $applicant_name
 * @param $applicant_phone
 * @param $point_val
 */
function getCondition($pr_id,$to_user,$applicant_name,$applicant_phone,$point_val){
    $prize_model=RelayPrize::findOne($pr_id);//奖品信息
    $prize_name=$prize_model->name;//奖品名称
    $prize_sponsor=$prize_model->sponsor;//赞助商
    $surplus=$prize_model->surplus;//剩余奖品数量
    $address=$prize_model->address;
    $awardsCount=RelayAwards::find()->where(['prize_id'=>$pr_id,'prize_winner'=>$to_user])->count();//查找是否获得过该奖品
    if($surplus>0&&$awardsCount==0){
        $awards=new RelayAwards();//实例化获奖信息
        $awards->isn='ZD'.date('YmdHis').rand(1000, 9999);;
        $awards->prize_id=$pr_id;
        $awards->prize_name=$prize_name;
        $awards->sponsor_name=$prize_sponsor;
        $awards->prize_winner=$to_user;
        $awards->name=$applicant_name;
        $awards->phone=$applicant_phone;
        $awards->point=$point_val;
        $awards->status=0;
        $awards->win_time=date('Y-m-d H:i:s');
        if($awards->save()){
            $prize_model->surplus=$surplus-1;//剩余奖品数量
            $prize_model->save();
            
            $isn=$awards->isn;
			$sms_content=$prize_sponsor.'知豆码：'.$isn;
          //  $sms_content='您在知豆汽车助力中的"充电"得由'.$prize_sponsor.'提供的'.$prize_name.',凭编号：'.$isn.'到'.$address.'LingQu!';
            Verification::send_sms($applicant_phone,$sms_content);
            
            $sms_model=new Verification();
            $sms_model->code=0000;
            $sms_model->phone=$applicant_phone;
            $sms_model->status=1;
            $sms_model->click=1;
            $sms_model->totalclick=1;
            $sms_model->time=date('Y-m-d H:i:s');
            $sms_model->remarks=$sms_content;
            $sms_model->save();
        }
    }
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\activitys\controllers;


use Yii;
use backend\modules\activitys\models\RelayActivitys;
use backend\modules\activitys\models\RelayApplicants;
use backend\modules\activitys\models\RelayRecords;
use common\models\NUser;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Description of RelayController
 *
 * @author Administrator
 */
//class RelayController extends BaseController
class RelayController extends Controller
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
   * @param type $id
   * @param type $openid
   * @return type
   */
     public function actionIndex($id='',$openid='')
    {
		 NUser::moveToNUser();
		$wechatId=Yii::$app->user->identity->wechatId;
        $model=RelayActivitys::findOne($id);//查询活动
        if($id!=''){
            $model->visit=$model->visit+1;
            $model->save();//浏览次数加1后保存
        }
        $applicants=RelayApplicants::find()->limit(50)->where(['activity_id'=>$id])->orderBy('point desc')->all();//查询出已报名的相对活动的报名信息
        $isbm=RelayApplicants::find()->where(['and',['activity_id'=>$id,'wechat_id'=>$wechatId]])->count();//查找当前活动的当前用户是否已经报名
        if($openid==''||$openid==$wechatId){ $pd=1; } else { $pd=0; }//判断openid传过来的值是否为空或是否相同
        $zrs_count=RelayApplicants::find()->where(['activity_id'=>$id])->count();//该活动总的参与人数
       $point_relar=RelayApplicants::find()->where(['and',['activity_id'=>$id,'wechat_id'=>$wechatId]])->one();
       $point_count=count($point_relar);
       if($point_count>0){
            $point=$point_relar['point'];//该用户助力值
            $sql="select * FROM `j_relay_applicants` where `point`>$point and `activity_id`=$id";
            $greater=RelayApplicants::findBySql($sql)->all();//助力值大于该用户的所以数据
            $rank=count($greater)+1;//该用户排名
	 }else {
		$point=0;//助力值
		$rank=0;//该用户排名
       }

         if(isset($openid)!=null){
             $point_relars=RelayApplicants::find()->where(['and',['activity_id'=>$id,'wechat_id'=>$openid]])->one();
             $relars_count=count($point_relars);
            if($relars_count>0){
                $friend_point=$point_relars['point'];//朋友的助力值
		$sql1="select * FROM `j_relay_applicants` where `point`>$friend_point and `activity_id`=$id";
		$greaters=RelayApplicants::findBySql($sql1)->all();//助力值大于该用户的所以数据
		$friend_rank=count($greaters)+1;//朋友排名
             }else {
                 $friend_point=0;
		 $friend_rank=0;//朋友排名
            }
    }
     return $this->render('index',[
            'model'=>$model,
            'applicants'=>$applicants,
            'isbm'=>$isbm,
            'pd'=>$pd,
           'zrs_count'=>$zrs_count,
            'wechatId'=>$wechatId,
            'point'=>$point,//该用户助力值
            'rank'=>$rank,//该用户排名
            'friend_point'=>$friend_point,//朋友的助力值
            'friend_rank'=>$friend_rank,//朋友排名
        ] );
    }
    /**
     * 微助力报名信息保存
     * @return type
     */
     public function actionApplicants()
    {
		$wechatId=Yii::$app->user->identity->wechatId;
//	 $wechatId='oW2yKjgaf8fAuYYdkjSMUEbZ2n7o';
        //$wechatId='oW2yKjoG_HcenQWacoPeOJGZ76Ws';
        $activity_id=$_POST['activity_id'];
        $isbm=  RelayApplicants::find()->where(['and',['activity_id'=>$activity_id,'wechat_id'=>$wechatId]])->count();//超找当前活动的当前用户是否已经报名
        if($isbm!=1){
            $model =new RelayApplicants();
            $model->wechat_id=$wechatId;
            $model->activity_id=$activity_id;
            $model->name=$_POST['name'];
            $model->mobilephone=$_POST['phone'];
            $model->datetime=date("Y-m-d H:i:s",time());//当前日期时间格式化
            if( $model->save()){
                $activitys=RelayActivitys::findOne($activity_id);
                $activitys->willnum=$model->willnum+1;
                $activitys->save();//报名人数加1
            }
        }
    }
    /**
     * 保存助力值
     * @return type
     */
     public function actionPointsave()
    {
       $model =new RelayRecords();
	   $wechatId=Yii::$app->user->identity->wechatId;
//       $wechatId='oW2yKjgaf8fAuYYdkjSMUEbZ2n7o';//谁投的票
      // $wechatId='oW2yKjoG_HcenQWacoPeOJGZ76Ws';
       $activity_id=$_POST['activity_id'];//获取活动ID
       $to_user=$_POST['to_user'];//投票给谁
       $date=date("Y-m-d",time());//投票时间
       
       $activity=RelayActivitys::findOne($activity_id);//查询活动
       $type=$activity['type'];
        if ($type==1){
            $count_model=RelayRecords::find()->where(['and',['activity_id'=>$activity_id,'to_user'=>$to_user,'from_user'=>$wechatId]])->count();//统计投票记录中是否有该记录
            $strResult='3';
            if($count_model==1){
                 $strResult= '3';
            }else {
                $model->activity_id=$activity_id;
                $model->to_user=$to_user;
                $model->from_user=$wechatId;
                $model->date=$date;//当前日期格式化
                 if($model->save()){
                    $point_model= RelayApplicants::find()->where(['and',['activity_id'=>$activity_id,'wechat_id'=>$to_user]])->one();
                    $point_model->point=$point_model->point+1;
                    $point_model->save();
                }
                $strResult='4';
            }
        }
       if ($type==2){
            $count_model=RelayRecords::find()->where(['and',['activity_id'=>$activity_id,'to_user'=>$to_user,'from_user'=>$wechatId,'date'=>$date]])->count();//统计投票记录中是否有该记录
            $strResult='1';
            if($count_model==1){
                 $strResult= '1';
            }else {
                $model->activity_id=$activity_id;
                $model->to_user=$to_user;
                $model->from_user=$wechatId;
                $model->date=$date;//当前日期格式化
                 if($model->save()){
                    $point_model= RelayApplicants::find()->where(['and',['activity_id'=>$activity_id,'wechat_id'=>$to_user]])->one();
                    $point_model->point=$point_model->point+1;
                    $point_model->save();
                }
                $strResult='0';
            }
        }
         return $strResult;   
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\activitys\controllers;



use backend\modules\activitys\models\ApplyActivity;
use backend\modules\activitys\models\ApplyAttend;
use backend\modules\activitys\models\ApplyAudit;
use backend\modules\activitys\models\RelayActivity;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\controllers\BaseController;
/**
 * Description of RelayController
 *
 * @author Administrator
 */
class ApplyController extends BaseController
//class ApplyController extends Controller
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
     * 我要报名
     * @param string $aid
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionAttend($aid=''){
        $applyActivity=ApplyActivity::findOne($aid);
        if ($applyActivity!== null) {
            $now_time=strtotime(date('Y-m-d H:i:s')); //当前时间
            $end_time=strtotime($applyActivity['end_time']); //活动结束时间
           if ($end_time<$now_time){//活动已结束
               throw new NotFoundHttpException('活动已经结束！');
            }else{
                 $wechat_openid=$this->openid;
              // $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
               //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';
               $apply_con=ApplyAttend::find()->where(['aid'=>$aid,'uid'=>$wechat_openid])->count();
               if($apply_con==0){
                   return $this->render('attend',[
                       'aid'=>$aid,
                   ]);
               }else{
                   return $this->redirect(['details','aid' =>$aid]);
               }
            }
        } else {
            throw new NotFoundHttpException('没有该活动信息！');
        }
    }

    /**
     * 报名信息保存
     * @return type
     */
    public function actionAdd(){
         $wechat_openid=$this->openid;
        // $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';
        $activity_id= Yii::$app->request->post('activity_id');
        $name= Yii::$app->request->post('name');
        $phone= Yii::$app->request->post('phone');
        $number= Yii::$app->request->post('number');
        $remark= Yii::$app->request->post('remark');
        $applyActivity=ApplyActivity::findOne($activity_id);
        if (($applyActivity) !== null) {
            $isApply=ApplyAttend::find()->where(['aid'=>$activity_id,'uid'=>$wechat_openid])->one();
            if($isApply===null){
                if($activity_id&&$name&&$phone&&$number) {
                    $restrict=$applyActivity['restrict'];//上限人数
                    $willnum=$applyActivity['willnum'];//已报名人数
                    $surplus=$restrict-$willnum;//剩余名额
                    if($number<=$surplus){
                        $model = new ApplyAttend();
                        $model->uid = $wechat_openid;
                        $model->aid = $activity_id;
                        $model->number = $number;
                        $model->name=$name;
                        $model->phone = $phone;
                        $model->remark = $remark;
                        $model->ispay =0;
                        $model->status =1;
                        if ($model->save()) {
                            ApplyActivity::updateAllCounters(['willnum' => 1], ['id' => $activity_id]);//报名人数加1
                            $strResult='';
                        }else{
                            $strResult='报名失败！';
                        }
                    }else{
                        $strResult='名额不足！只剩：'.$surplus.'个名额！';
                    }

                }else{
                    $strResult='没有相关参数！';
                }
            }else{
                $strResult='您已报过名了，不能重复报名！';
            }

        } else {
            $strResult='没有该条活动记录！';
        }
        return $strResult;
    }

    /**
     * 报名详情
     * @param string $aid
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDetails($aid=''){
         $wechat_openid=$this->openid;
        // $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';
        $applyAttend=ApplyAttend::find()->where(['aid'=>$aid,'uid'=>$wechat_openid])->one();
        if ($applyAttend !== null) {
            return $this->render('details',[
                'applyAttend'=>$applyAttend
            ]);
        } else {
            throw new NotFoundHttpException('没有该条记录');
        }
    }
	
	
	  /**
     * 审核列表
     * @return string
     */
   public function actionIndex($aid=''){
       $applyActivity=ApplyActivity::findOne($aid);
       if ($applyActivity!==null) {
            $wechat_openid=$this->openid;
           //  $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
           //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';

           $message=$applyActivity['message'];
           //$message="oV1VUt6RUheAI-xfveukXdNW2ak8,oV1VUt0U0HE0F5T3sCry_LGaFuSA";
            $mess_push=explode(',',$message);
            $mess=array_unique($mess_push);
            //in_array(value,array,type)
            $isin = in_array($wechat_openid,$mess);//php判断数组元素中是否存在某个字符串的方法
            if($isin){//存在

                     $applyAttend=ApplyAttend::find()->where(['aid'=>$aid])->orderBy('id desc')->all();
                    return $this->render('index',[
                        'applyAttend'=>$applyAttend,
                        'aid'=>$aid
                    ]);

            }else{//不存在
                 return $this->redirect(['default/hint','aid' =>$aid]);
            }
       } else {
            throw new NotFoundHttpException('没有该条活动！');
       }

    }
	 public function actionUpdate($id=''){
        if (( $applyAttend=ApplyAttend::findOne($id)) !== null) {
            $aid=$applyAttend['aid'];
            $applyActivity=ApplyActivity::findOne($aid);
            if ($applyActivity!==null) {
                $wechat_openid=$this->openid;
                //  $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
                //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';
                $message=$applyActivity['message'];
                $mess_push=explode(',',$message);
                $mess=array_unique($mess_push);
                $isin = in_array($wechat_openid,$mess);//php判断数组元素中是否存在某个字符串的方法
                if($isin){//存在
                    return $this->render('update',[
                        'applyAttend'=>$applyAttend
                    ]);

                }else{//不存在
                    throw new NotFoundHttpException('您不是管理员，没有该权限！！');
                }
            } else {
                throw new NotFoundHttpException('没有该条活动！');
            }

        } else {
            throw new NotFoundHttpException('没有该报名记录');
        }
    }

    /**
     * 修改报名信息保存
     * @return type
     */
    public function actionUpdatesave(){
        $id= Yii::$app->request->post('id');
        $cost= Yii::$app->request->post('cost');
        $ispay= Yii::$app->request->post('ispay');
        $status= Yii::$app->request->post('status');
        $explain= Yii::$app->request->post('explain');
        $model = ApplyAttend::findOne($id);
        if ($model !== null) {
            $aid=$model['aid'];
            $applyActivity=ApplyActivity::findOne($aid);
            if ($applyActivity!==null) {
                $wechat_openid=$this->openid;
                //  $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
                //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';
                $message=$applyActivity['message'];
                $mess_push=explode(',',$message);
                $mess=array_unique($mess_push);
                $isin = in_array($wechat_openid,$mess);//php判断数组元素中是否存在某个字符串的方法
                if($isin){//存在
                    $model->cost=$cost;
                    $model->ispay = $ispay;
                    $model->explain = $explain;
                    $model->ispay =$ispay;
                    $model->status =$status;
                    if ($model->save()) {
                        $strResult='';
                    }else{
                        $strResult='报名失败！';
                    }
                }else{//不存在
                    throw new NotFoundHttpException('您不是管理员，没有该权限！！');
                }
            } else {
                throw new NotFoundHttpException('没有该条活动！');
            }

        } else {
            throw new NotFoundHttpException('没有该报名记录');
        }
        return $strResult;
    }

    /**
     * 管理员申请审核列表
     * @return string
     */
    public function actionAdminlist($aid=''){
        $applyActivity=ApplyActivity::findOne($aid);
        if ($applyActivity!==null) {
            $wechat_openid=$this->openid;
            //  $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
            //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';

            $message=$applyActivity['message'];
            //$message="oV1VUt6RUheAI-xfveukXdNW2ak8,oV1VUt0U0HE0F5T3sCry_LGaFuSA";
            $mess_push=explode(',',$message);
            $mess=array_unique($mess_push);
            //in_array(value,array,type)
            $isin = in_array($wechat_openid,$mess);//php判断数组元素中是否存在某个字符串的方法
            if($isin){//存在

                $applyAudit=ApplyAudit::find()->where(['aid'=>$aid])->all();
                return $this->render('adminlist',[
                    'applyAudit'=>$applyAudit,
                ]);

            }else{//不存在
                   return $this->redirect(['apply/admin','aid' =>$aid]);
            }
        } else {
            throw new NotFoundHttpException('没有该条活动！');
        }

    }


    /**
     * 申请管理员
     * @return string
     */
    public function actionAdmin($aid=''){
        $applyActivity=ApplyActivity::findOne($aid);
        if ($applyActivity!== null) {
             $wechat_openid=$this->openid;
            // $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
            //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';
            return $this->render('admin',[
                'wechat_openid'=>$wechat_openid,
                'aid'=>$aid,
            ]);

        } else {
            throw new NotFoundHttpException('没有该活动信息！');
        }
    }

    /**
     * 保存管理员信息
     * @return string
     * author Fox
     */
    public function actionAdminadd() {
        $wechat_openid=$this->openid;
        //  $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';
        $activity_id = Yii::$app->request->post('aid');
        $name = Yii::$app->request->post('name');
        $phone = Yii::$app->request->post('phone');
        $wx = Yii::$app->request->post('wx');
        $remark = Yii::$app->request->post('remark');
		$controllerID = Yii::$app->controller->id;
        $isApply = ApplyAudit::find()->where(['aid' => $activity_id, 'item'=>$controllerID,'uid' => $wechat_openid])->one();
        if ($isApply === null) {
            if ($activity_id && $name && $phone&& $wx) {
                $model = new ApplyAudit();
                $model->uid = $wechat_openid;
                $model->aid = $activity_id;
                $model->item =$controllerID;
                $model->name = $name;
                $model->phone = $phone;
                $model->remark = $remark;
                $model->wx_number =$wx;
                $model->status = 1;
                if ($model->save()) {
                    $strResult = '';
                } else {
                    $strResult = '申请失败！';
                }
            } else {
                $strResult = '没有相关参数！';
            }
        } else {
            $strResult = '您已申请过了，不能重复报名！';
        }
        return $strResult;
    }

    /**
     * 修改管理员信息
     * @param string $id
     * @return string
     * author Fox
     * @throws NotFoundHttpException
     */
    public function actionAdmupd($id=''){
        if (( $applyAudit=ApplyAudit::findOne($id)) !== null) {
            $aid=$applyAudit['aid'];
            $applyActivity=ApplyActivity::findOne($aid);
            if ($applyActivity!==null) {
                $wechat_openid=$this->openid;
                //  $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
                //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';
                $message=$applyActivity['message'];
                $mess_push=explode(',',$message);
                $mess=array_unique($mess_push);
                $isin = in_array($wechat_openid,$mess);//php判断数组元素中是否存在某个字符串的方法
                if($isin){//存在
                    return $this->render('admupd',[
                        'applyAudit'=>$applyAudit
                    ]);

                }else{//不存在
                    throw new NotFoundHttpException('您不是管理员，没有该权限！！');
                }
            } else {
                throw new NotFoundHttpException('没有该条活动！');
            }

        } else {
            throw new NotFoundHttpException('没有该报名记录');
        }
    }
    /**
     * 修改管理员信息保存
     * @return type
     */
    public function actionAdmupdsave(){
        $id= Yii::$app->request->post('id');
        $status= Yii::$app->request->post('status');
        $model = ApplyAudit::findOne($id);
        if ($model !== null) {
            $aid=$model['aid'];
            $uid=$model['uid'];
            $applyActivity=ApplyActivity::findOne($aid);
            if ($applyActivity!==null) {
                $wechat_openid=$this->openid;
                //  $wechat_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
                //  $wechat_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';
                $message=$applyActivity['message'];
                $mess_push=explode(',',$message);
                $mess=array_unique($mess_push);
                $isin = in_array($wechat_openid,$mess);//php判断数组元素中是否存在某个字符串的方法
                if($isin){//存在
                    $model->status =$status;
                    if ($model->save()) {
                        if($status==2){
                            $applyActivity->message=$message.','.$uid;
                            $applyActivity->save();
                        }
                        $strResult='';
                    }else{
                        $strResult='报名失败！';
                    }
                }else{//不存在
                    throw new NotFoundHttpException('您不是管理员，没有该权限！！');
                }
            } else {
                throw new NotFoundHttpException('没有该条活动！');
            }

        } else {
            throw new NotFoundHttpException('没有该申请记录');
        }
        return $strResult;
    }


}

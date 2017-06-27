<?php

namespace frontend\modules\activitys\controllers;

use backend\modules\activitys\models\ApplyActivity;
use backend\modules\activitys\models\ApplyAttend;
use backend\modules\activitys\models\RelayActivity;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `activitys` module
 */
class DefaultController extends Controller
{
    /**
     * 活动列表
     * @return string
     */
    public function actionList(){
        $activity=RelayActivity::find()->where(['status'=>1])->orderBy('id desc')->all();
        return $this->render('list',[
            'activity'=>$activity,
        ]);
    }

   /**
     * 活动报名
     * @param string $aid
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionApply($aid=''){
        $applyActivity=ApplyActivity::findOne($aid);
        if ($applyActivity!== null) {
            $applyAttend=ApplyAttend::find()->where(['aid'=>$aid])->all();
            $number=0;//设变量
            foreach ($applyAttend as $_v){
                $number+=$_v['number'];//累加
            }

            ApplyActivity::updateAllCounters(['pv' => 1], ['id' => $aid]);//浏览次数加1
            return $this->render('apply',[
                'applyActivity'=>$applyActivity,
                'number'=>$number
            ]);
        } else {
            throw new NotFoundHttpException('没有该活动信息！');
        }

    }


    /**
     * 活动报名记录
     * @param string $aid
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionApplyrecord($aid=''){
        $applyActivity=ApplyActivity::findOne($aid);
        if ($applyActivity!== null) {
            $applyAttend=ApplyAttend::find()->where(['aid'=>$aid])->orderBy('id desc')->all();
            return $this->render('applyrecord',[
                'applyAttend'=>$applyAttend
            ]);
        } else {
            throw new NotFoundHttpException('没有该活动信息！');
        }
    }

    /**
     * 关于我们
     * @return string
     */
    public function actionAbout(){
        return $this->render('about',[
        ]);
    }

      /**
     * 提示没有管理员权限
     * @return string
     */
    public function actionHint($aid=''){
        return $this->render('hint',[
            'aid'=>$aid
        ]);
    }


    /**
     * 报名后提示成功
     * @return string
     */
    public function actionSuccess(){
        return $this->render('success',[
        ]);
    }

    /**
     * 申请审核提示
     * @return string
     */
    public function actionScs(){
        return $this->render('scs',[
        ]);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

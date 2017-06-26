<?php

namespace frontend\modules\activitys\controllers;

use backend\modules\activitys\models\RelayActivity;
use yii\web\Controller;

/**
 * Default controller for the `activitys` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionList(){
        $activity=RelayActivity::find()->where(['status'=>1])->orderBy('id desc')->all();
        return $this->render('list',[
            'activity'=>$activity,
        ]);
    }
}

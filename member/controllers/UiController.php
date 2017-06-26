<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-18
 * Time: 16:04
 */

namespace member\controllers;


use Yii;
use yii\web\Controller;

class UiController extends BaseController
{
    public function beforeAction($action)
    {
        $action ='/'.Yii::$app->controller->id .'/'. Yii::$app->controller->action->id;
        if(Yii::$app->user->can($action)){
            return true;
        }else{
            throw new \yii\web\UnauthorizedHttpException('对不起，您现在还没获此操作的权限');
        }
    }
    /**
     * 图标-Icons
     * @return string
     */
    public function actionIcons()
    {
        return $this->render('icons');
    }
    /**
     * 按钮-Buttons
     * @return string
     */
    public function actionButtons()
    {
        return $this->render('buttons');
    }
    /**
     * 时间轴-Timeline
     * @return string
     */
    public function actionTimeline()
    {
        return $this->render('timeline');
    }
}
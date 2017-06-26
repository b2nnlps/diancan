<?php

namespace frontend\components;

use Yii;

class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!Yii::$app->session->isActive)// 检查session会话是否已经开启
                Yii::$app->session->open();// open a session
            return true;
        } else {
            return false;
        }
    }

}
<?php

namespace member\modules\sys\controllers;

use Yii;

use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;


/**
 * LinkController implements the CRUD actions for Link model.
 */
class BaseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            //必须先登录才能执行具体方法，否则跳转到登录页面
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

    public function beforeAction($action)
    {
        // $action ='/'.Yii::$app->controller->module->id .'/'.Yii::$app->controller->id .'/'. Yii::$app->controller->action->id;
        // if(Yii::$app->user->can($action)){
        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID
        if ($role < 3) {//如果是超级管理员或系统管理员才能访问
            return true;
        } else {
            throw new HttpException(403, '对不起，您现在还没获此操作的权限！');
        }
    }


}
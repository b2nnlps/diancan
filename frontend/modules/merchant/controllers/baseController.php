<?php

namespace frontend\modules\merchant\controllers;

use backend\modules\merchant\models\Member;
use yii\web\Controller;

/**
 * Default controller for the `merchant` module
 */
//class BaseController extends \frontend\controllers\BaseController{
class BaseController extends Controller{
    public $rh_openid=null;
    public $wx_openid=null;
    
    public function beforeAction($action){
       // $wx_openid=$this->openid;
       $wx_openid= 'oV1VUt2eF6yCmBOEJPj3_ihoZpS0';
        //   $wx_openid= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $member=Member::find()->where(['wx_openid'=>$wx_openid])->one();
        if(!empty($member)){
            $this->rh_openid=$member['rh_openid'];
        }
        $this->wx_openid=$wx_openid;
        return parent::beforeAction($action);
        

    }

}

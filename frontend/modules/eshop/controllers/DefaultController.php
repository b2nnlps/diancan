<?php

namespace frontend\modules\eshop\controllers;

use backend\modules\sys\models\Member;
use yii\web\Controller;

/**
 * Default controller for the `eshop` module
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
    /**
     * 分享后的二维码
     * author Fox
     */
    public  function actionInvite($uid=''){
        if($uid!=""){
            $incite=Member::findOne($uid);
            $QRcode=$incite['ticket'];
            if($QRcode!=''||$QRcode!=null){
                return $this->render('invite',[
                    'QRcode'=>$QRcode,
                ]);
            }else{
                echo "没有找到该邀请！";
            }
        }else{
            echo "该链接已失效！";
        }
    }

}

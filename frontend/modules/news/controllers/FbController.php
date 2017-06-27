<?php

namespace frontend\modules\news\controllers;

use backend\modules\sys\models\SysFb;
use Yii;
use backend\modules\news\models\NewsInfo;
use common\widgets\Upload;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `news` module
 */
class FbController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex(){
        $fbModel=SysFb::find()->where(['status'=>0])->orderBy('id desc')->all();
        return $this->render('index',[
            'fbModel'=>$fbModel
        ]);
    }
    public function actionAdd(){
       
        return $this->render('add');
    }

    /**
     * 爆料内容保存
     * @return string
     */
    public function actionAddsave(){
        $title= Yii::$app->request->post('title');
        $content= Yii::$app->request->post('content');
        $phone= Yii::$app->request->post('phone');
        if ($title && $content) {
            $title1=preg_replace("/\s/","",$title);//php去掉字符串中的所有空格
            $titleLen=strlen($title1);//获取字符串长度：一个汉字长度为2；一个字母,标点符号或数字分别为1
            if(!preg_match("/(1[3-9]\d{9}$)/",$phone)&&$phone!=''){
                return $strResult="手机号码格式错误，请重新输入！";
            }else if($titleLen>125||$titleLen<0){
                return $strResult="爆料主题不能为空或超过255个字符！";
            }else{
                $fb=new SysFb();
                $fb->title=$title;
                $fb->content=$content;
                $fb->phone=$phone;
               if( $fb->save()){
                   return $strResult=Yii::$app->urlManager->createAbsoluteUrl(['news/fb/detail','id'=>$fb['id']]);
               }
            }
        }else{
            return $strResult="找不到相关参数！";
        }
    }
    public function actionDetail($id=''){
        $sysfb=SysFb::findOne($id);
        if ($sysfb !== null) {
            SysFb::updateAllCounters(['pv' => 1], ['id' =>$id]);//浏览次数加1
            return $this->render('detail',[
                'sysfb'=>$sysfb,
            ]);
        } else {
            throw new NotFoundHttpException('没有该条记录！.');
        }
    }
    public function actionFileupload(){

        $file = $_REQUEST['filed'];
        $data =Upload::base64_upload($file);
        return json_encode($data);
    }
}

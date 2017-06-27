<?php

namespace frontend\modules\news\controllers;

use backend\modules\sys\models\SysFb;
use common\widgets\PaginationBaseController;
use Yii;
//use backend\modules\news\models\NewsInfo;
use common\widgets\Upload;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `news` module
 */
class BlController extends Controller{
    public function init(){
        $this->enableCsrfValidation = false;
    }
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

        ];
    }

    /**
     * 爆料列表
     * @return string
     */
    public function actionIndex(){


        $cnt=SysFb::find()->where(['status'=>0])->count();//查找出总计录数目
        $per=10;//每页显示记录数
        $page=new PaginationBaseController($cnt,$per);//实例化分页类对象
        $sql="select * from {{%sys_fb}} where `status`=0  order by id desc $page->limit";//重新按照分页的样式拼装SQL语句进行查询
        $fbModel=SysFb::findBySql($sql)->all();//
           if($cnt<=$per){$pageArry=[4,6];}else{$pageArry=[4,5,6];}
        $page_list=$page->fpage($pageArry);//获得分页页面列表
        return $this->render('index',[
            'fbModel'=>$fbModel,
            'page_list'=>$page_list,
            'cnt'=>$cnt,
        ]);
        
    }

    /**
     * 我要爆料
     * @return string
     */
    public function actionAdd(){
        return $this->render('add');
    }

    /**
     * 爆料详情
     * @param string $id
     * @return string
     * @throws NotFoundHttpException
     */
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
    /**
     * 爆料内容保存
     * @return string
     */
    public function actionAddsave(){
        $sub_rand=Yii::$app->request->post('sub_rand');
        $yz=Yii::$app->session['bl_resubmit'];//获取session值
        if($yz==$sub_rand){//判断是否重复提交
            header('Content-type: text/html; charset=UTF8');
            echo '<script>alert("操作失败:不能重复提交数据哦！！!"); window.location.href="index"; </script>';
        }else{
            echo Yii::$app->session['bl_resubmit']=$sub_rand;//赋值给session
            $img_num=Yii::$app->request->post('img_num');
            $files='';
            for($i=1;$i<=$img_num;$i++) { 
                if (isset($_POST['img_'.$i])) {
                    if ($_POST['img_' . $i]!= '') {
                        $webroot = Yii::getAlias('@webroot');
                        $dir = '/upload/bl';
//                $dir ='/'.date('/Y/m/d');
                        if (!file_exists($webroot . $dir)) {
                            self::makeDir($webroot . $dir);
                        }
                        $timename = date("ymd") . '-' . mt_rand(100, 999);
                        $fileUrl = $dir . '/' . $timename . '.' . 'jpg';
                        $file = $webroot . $fileUrl;
                        $files .= $fileUrl . ',';
                        $temp = explode('$$$$$$', $_POST['img_' . $i]);
                        $data = preg_replace("/data:image\/(.*);base64,/", "", strtr($temp[0], ' ', '+'));
                        file_put_contents($file, base64_decode($data));
                    }
                }
            }
            $title= Yii::$app->request->post('title');
            $content= Yii::$app->request->post('content');
            $phone= Yii::$app->request->post('phone');
            if ($title && $content) {
                $title1=preg_replace("/\s/","",$title);//php去掉字符串中的所有空格
                $titleLen=strlen($title1);//获取字符串长度：一个汉字长度为2；一个字母,标点符号或数字分别为1
                if(!preg_match("/(1[3-9]\d{9}$)/",$phone)&&$phone!=''){
                    throw new NotFoundHttpException('手机号码格式错误，请重新输入！！');
                }else if($titleLen>125||$titleLen<0){
                    throw new NotFoundHttpException('爆料主题不能为空或超过255个字符！！');
                }else{
                    $fb=new SysFb();
                    $fb->title=$title;
                    $fb->content=$content;
                    $fb->img=rtrim($files, ",") ;//去掉最后一个“，”，并保存
                    $fb->phone=$phone;
                    if( $fb->save()){
                        return $this->redirect(['bl/detail','id' =>$fb['id']]);
                    }
                }
            }else{
                throw new NotFoundHttpException('找不到相关参数！！');
            }

        }
    }

    public static function makeDir($dir)
    {
        if (!is_dir($dir)) {
            if (!is_dir(dirname($dir))) {
                self::makeDir(dirname($dir));
                mkdir($dir, 0777);
            } else {
                mkdir($dir, 0777);
            }
        }
    }

}

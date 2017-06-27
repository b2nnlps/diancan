<?php
namespace frontend\controllers;

use backend\modules\sys\models\Member;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class DemoController extends Controller
{
    public $layout = false; //不使用布局
    public function init(){
        $this->enableCsrfValidation = false;
    }
//    public function actionIndex(){
//        return $this->render('index1', []);
//    }
//    public function actionMore(){
//        $page = intval($_GET['page']); //获取请求的页数
//        $start = $page*20;
//        $connection = Yii::$app->db;
//        $sql = "select * from  {{%sys_member}} order by created_time desc limit $start,20";
//        $command=$connection->createCommand($sql);
//        $user=$command->queryAll();
//        foreach ($user as $_v){
//            $sayList[]= array(
//                'phone'=>$_v['phone'],
//                'realname'=>$_v['realname'],
//                'date'=>$_v['created_time']
//            );
//        }
//
//        if(!empty($sayList)){
//            echo json_encode($sayList); //转换为json数据输出
//        }
//
//    }
//    public function actionMore1(){
//        $list_num = $_POST['list_num'];  //记录条数
//        $amount = $_POST['amount'];      //一次查询多少条
//
//        $connection = Yii::$app->db;
//        $sql = "select * from  {{%sys_member}} order by created_time desc limit $list_num,$amount";
//        $command=$connection->createCommand($sql);
//        $user=$command->queryAll();
//
//        if(empty($user)) {
//            echo 'not_more';
//        }else {
//            for($i=0;$i<count($user);$i++) {
//                echo <<<Eof
//                <div class="list">
//                    <div class="left">{$user[$i]['realname']}</div>
//                    <div class="right">{$user[$i]['phone']}</div>
//                </div>
//Eof;
//            };
//
//        }
//    }

}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-25
 * Time: 17:04
 */

namespace frontend\modules\eshop\controllers;

use Yii;
use backend\modules\eshop\models\Sumpplier;
use frontend\components\Controller;
use backend\modules\eshop\models\Product;
use frontend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use backend\modules\sys\models\WechatUser;

//class GoodController extends  Controller
class GoodController extends BaseController
{
    /**
     * 首页
     * @return string
     */
    public function actionIndex(){
         $user_id=$this->openid;
        //  $user_id= 'oV1VUt6RUheAI-xfveukXdNW2ak8';
        $sumpplier=Sumpplier::find()->where(['status'=>1])->orderBy('sort asc')->all();
        return $this->render('index',[
            'sumpplier'=>$sumpplier,
            'user_id'=>$user_id,
        ]);
    }

    /**
     * 商品列表
     * @param $sump_id
     * @return string
     */
    public function actionProductList($sump_id){
        $model=Product::find()->where(['status'=>1,'supplier_id'=>$sump_id])->asArray()->all();
        $sumpplier=Sumpplier::findOne($sump_id);
        Sumpplier::updateAllCounters(['views' => 1], ['id' => $sump_id]);//浏览次数加1
        return $this->render('product-list',[
            'model'=>$model,
            'sumpplier'=>$sumpplier,
            'supplier_id'=>$sump_id,
        ]);
    }

    /**
     * 商品详情
     * @param $id
     * @return string
     */
    public function actionCommodity($id){
        return $this->render('commodity',[
            'model'=> $this->findModel($id),
        ]);
    }
  public function actionMore(){
        $list_num = $_POST['list_num'];  //记录条数
        $amount = $_POST['amount'];      //一次查询多少条
        $product_id=$_POST['product_id'];
        $connection = Yii::$app->db;
        $sql = "select * from   {{%eshop_orderproduct}} where product_id=$product_id and status=10  order by id desc limit $list_num,$amount";
        $command=$connection->createCommand($sql);
        $orderproduct=$command->queryAll();

        if(empty($orderproduct)) {
            echo 'not_more';
        }else {
            for($i=0;$i<count($orderproduct);$i++) {
                $headimgurl=WechatUser::getHeadimgurl($orderproduct[$i]['user_id']);
                $nickname=WechatUser::getNickname($orderproduct[$i]['user_id']);
                echo <<<Eof
                 <dl class="nm">
                        <dt><img src="{$headimgurl}"></dt>
                        <dd>
                            <h4>{$nickname}</h4>
                            <span>{$orderproduct[$i]['created_time']}&nbsp;&nbsp;订购：{$orderproduct[$i]['number']} {$orderproduct[$i]['sku']}</span>
                        </dd>
                        <div class="clear"></div>
                    </dl>
Eof;
            };
        }
    }
    /**
     * 商品
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function findModel($id){
        if (($model = Product::findOne($id)) !== null) {
            Product::updateAllCounters(['pv' => 1], ['id' => $id]);//浏览次数加1
            return $model;
        } else {
            throw new NotFoundHttpException('没有该页面！');
        }
    }
    
    
}
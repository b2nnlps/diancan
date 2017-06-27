<?php

namespace frontend\modules\merchant\controllers;

use backend\modules\sys\models\WechatUser;
use backend\modules\merchant\models\Cart;
use backend\modules\merchant\models\Member;
use Yii;
use backend\modules\merchant\models\Agent;
use backend\modules\merchant\models\Product;
use backend\modules\merchant\models\Supplier;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\controllers\BaseController;

/**
 * Default controller for the `merchant` module
 */
class GoodController extends BaseController
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
     * 商品列表
     * @param $sump_id
     * @return string
     */
    public function actionProductList($sid=''){
        $rh_openid=$this->rh_openid;
        if (($model =Member::find()->where(['rh_openid'=>$rh_openid])->one()) !== null) {
            $supplier = $this->findSupplier($sid);
            $supplierRank=$supplier['rank'];
            $rank=$model['rank'];
            if($rank<3&&$supplierRank==1){
                $agent=Agent::find()->where(['supplier_id'=>$sid])->all();
                return $this->render('product-list',[
                    'sid'=>$sid,
                    'agent'=>$agent,
                    'supplier'=>$supplier,
                ]);
            }else{
                throw new NotFoundHttpException('暂无此权限！！');
            }

        } else {
           // return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/add']));
            return $this->redirect('../user/add');
        }

    }
 
    /**
     * 商品详情
     * @param $id
     * @return string
     */
    public function actionCommodity($aid){
        $model = $this->findAgent($aid);
        $product_id=$model['product_id'];
        $supplier_id=$model['supplier_id'];
        $product= $this->findProduct($product_id);
        $supplier=$this->findSupplier($supplier_id);
//        $rh_openid=$model['rh_openid'];
//        $member=Member::find()->where(['rh_openid'=>$rh_openid])->one();
//        $wx_openid=$member['wx_openid'];
        return $this->render('commodity',[
            'model'=>$model,
//            'wx_openid'=>$wx_openid,
            'product'=>$product,
            'supplier'=>$supplier,
        ]);
    }




    public function actionMore(){
        $list_num = $_POST['list_num'];  //记录条数
        $amount = $_POST['amount'];      //一次查询多少条
        $product_id=$_POST['product_id'];
        $connection = Yii::$app->db;
        $sql = "select * from   {{%merchant_orderproduct}} where product_id=$product_id and status=10  order by id desc limit $list_num,$amount";
        $command=$connection->createCommand($sql);
        $orderproduct=$command->queryAll();

        if(empty($orderproduct)) {
            echo 'not_more';
        }else {
            for($i=0;$i<count($orderproduct);$i++) {
                $rh_openid=$orderproduct[$i]['rh_openid'];
                $member=\backend\modules\merchant\models\Member::find()->where(['rh_openid'=>$rh_openid])->one();
                $wx_openid=$member['wx_openid'];
                $headimgurl=WechatUser::getHeadimgurl($wx_openid);
                $nickname=WechatUser::getNickname($wx_openid);
                echo <<<Eof
                 <dl class="lists">
                        <dt><img src="{$headimgurl}"></dt>
                        <dd>
                            <h4>{$nickname}</h4>
                            <span>{$orderproduct[$i]['time']}&nbsp;&nbsp;订购：{$orderproduct[$i]['number']} {$orderproduct[$i]['sku']}</span>
                        </dd>
                        <div class="clear"></div>
                    </dl>
Eof;
            };
        }
    }


    protected function findSupplier($id){
        if (($model = Supplier::findOne($id)) !== null) {
            Supplier::updateAllCounters(['pv' => 1], ['id' => $id]);//浏览次数加1
            return $model;
        } else {
            throw new NotFoundHttpException('所请求页面不存在！');
        }
    }

    protected function findProduct($id){
        if (($model = Product::findOne($id)) !== null) {
            Product::updateAllCounters(['pv' => 1], ['id' => $id]);//浏览次数加1
            return $model;
        } else {
            throw new NotFoundHttpException('所请求页面不存在！');
        }
    }
    protected function findAgent($id){
        if (($model = Agent::findOne($id)) !== null) {
            Agent::updateAllCounters(['pv' => 1], ['id' => $id]);//浏览次数加1
            return $model;
        } else {
            throw new NotFoundHttpException('所请求页面不存在！');
        }
    }

}

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
        $sumpplier=Sumpplier::find()->where(['status'=>1])->all();
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
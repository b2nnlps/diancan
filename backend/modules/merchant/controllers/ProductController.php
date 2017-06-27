<?php

namespace backend\modules\merchant\controllers;

use backend\modules\merchant\models\Agent;
use backend\modules\news\models\NewsCategory;
use backend\modules\merchant\models\Supplier;
use Yii;
use backend\modules\merchant\models\Product;
use backend\modules\merchant\models\search\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\BaseController;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BaseController
{
  
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->created_by=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            //            $agent->supplier_id=$_POST['Product']['supplier_id'];
            if( $model->save()){
                 $supplier_id=$model->supplier_id;
                $supplier=Supplier::findOne($supplier_id);
                $rh_openid=$supplier['rh_openid'];
                $agent=new Agent();
                $agent->rh_openid= $rh_openid;
                $agent->supplier_id= $supplier_id;
                $agent->stock= $model->stock;
                $agent->bookable= $model->bookable;
                $agent->sales= $model->sales;
                $agent->market_price= $model->market_price;
                $agent->price= $model->price;
                if( $agent->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_by=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            if( $model->save()){
                $agent=Agent::find()->where(['product_id'=>$id])->one();
                if(empty($agent)){
                    $agent=new Agent();
                }
                $agent->supplier_id= $model->supplier_id;
                $agent->product_id= $model->id;
                $agent->stock= $model->stock;
                $agent->bookable= $model->bookable;
                $agent->sales= $model->sales;
                $agent->market_price= $model->market_price;
                $agent->price= $model->price;
                $agent->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

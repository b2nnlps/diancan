<?php

namespace backend\modules\activitys\controllers;

use backend\controllers\BaseController;
use dosamigos\qrcode\formats\MeCard;
use dosamigos\qrcode\QrCode;
use Yii;
use backend\modules\activitys\models\ApplyActivity;
use backend\modules\activitys\models\search\ApplyactivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApplyactivityController implements the CRUD actions for ApplyActivity model.
 */
//class ApplyactivityController extends Controller
class ApplyactivityController extends BaseController
{
  
  
    /**
     * Lists all ApplyActivity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApplyactivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ApplyActivity model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionQrcode($aid)
    {
        return QrCode::png('http://ms.n39.cn/activitys/default/apply?aid=' . $aid);    //调用二维码生成方法
    }

    public function actionHdgl($aid)
    {
        return QrCode::png('http://ms.n39.cn/activitys/apply/index?aid=' . $aid);    //调用二维码生成方法
    }
    /**
     * Creates a new ApplyActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ApplyActivity();
        $model->u_id=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ApplyActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->u_id=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ApplyActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ApplyActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ApplyActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ApplyActivity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

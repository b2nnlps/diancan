<?php

namespace backend\modules\news\controllers;

use backend\controllers\BaseController;
use backend\modules\news\models\NewsCategory;
use Yii;
use backend\modules\news\models\NewsInfo;
use backend\modules\news\models\search\InfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InfoController implements the CRUD actions for NewsInfo model.
 */
class InfoController extends BaseController
//class InfoController extends Controller
{
   

    /**
     * Lists all NewsInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new NewsCategory();
        $list = $model->getOptions();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'list' => $list
        ]);
    }

    /**
     * Displays a single NewsInfo model.
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
     * Creates a new NewsInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewsInfo();
        $model->uid=Yii::$app->user->id;
        $categoryModel = new NewsCategory();
        $list = $categoryModel->getOptions();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'list' => $list
            ]);
        }
    }

    /**
     * Updates an existing NewsInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->uid=Yii::$app->user->id;
        $categoryModel = new NewsCategory();
        $list = $categoryModel->getOptions();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'list' => $list
            ]);
        }
    }

    /**
     * Deletes an existing NewsInfo model.
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
     * Finds the NewsInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NewsInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NewsInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace member\modules\sys\controllers;

use member\controllers\BaseController;
use Yii;
use member\modules\sys\models\user;
use member\modules\sys\models\search\UserSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for user model.
 */
class UserController extends BaseController
{
    /**
     * Lists all user models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single user model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID
        if ($role < 3) {//如果是超级管理员或系统管理员才能访问
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new HttpException(403, '对不起，您现在还没获此操作的权限！');
        }

    }

    /**
     * Creates a new user model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID
        if ($role < 3) {//如果是超级管理员或系统管理员才能访问
            $model = new user(['scenario' => 'admin-create']);
            $model->creater = Yii::$app->user->id;
            $model->modules = 3;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new HttpException(403, '对不起，您现在还没获此操作的权限！');
        }

    }

    /**
     * Updates an existing user model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID
        if ($role < 3) {//如果是超级管理员或系统管理员才能访问
            $model = $this->findModel($id);
            $model->setScenario('admin-update');
            $model->creater = Yii::$app->user->id;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new HttpException(403, '对不起，您现在还没获此操作的权限！');
        }

    }

    /**
     * Deletes an existing user model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID
        if ($role < 3) {//如果是超级管理员或系统管理员才能访问

//        $this->findModel($id)->delete();
            $model = $this->findModel($id);
            $model->setScenario('admin-update');
            $model->status = Status::STATUS_DELETED;
            $model->save();
            return $this->redirect(['index']);
        } else {
            throw new HttpException(403, '对不起，您现在还没获此操作的权限！');
        }

    }
    /**
     * Batch delete existing Product models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBatchDelete()
    {

        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID
        if ($role < 3) {//如果是超级管理员或系统管理员才能访问
            //if(!Yii::$app->user->can('deleteYourAuth')) throw new ForbiddenHttpException(Yii::t('app', 'No Auth'));
            $ids = Yii::$app->request->post('ids');
            if (is_array($ids)) {
                foreach ($ids as $id) {
                    $this->findModel($id)->delete();
//                $model = $this->findModel($id);
//                $model->setScenario('admin-update');
//                $model->status = Status::STATUS_DELETED;
//                $model->save();
                }
            }
            return $this->redirect(['index']);
        } else {
            throw new HttpException(403, '对不起，您现在还没获此操作的权限！');
        }

    }
    /**
     * Finds the user model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return user the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = user::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('所请求的页面不存在.');
        }
    }
}

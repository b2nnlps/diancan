<?php

namespace backend\modules\sys\controllers;

use backend\controllers\BaseController;
use dosamigos\qrcode\formats\MeCard;
use dosamigos\qrcode\QrCode;
use Yii;
use backend\modules\sys\models\Member;
use backend\modules\sys\models\search\MemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends BaseController
{
    /**
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Member model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionQrcode($uid)
    {
        $member = Member::findOne($uid);
        $card = new MeCard();
        $card->firstName = $member->realname;
        $card->lastName = '';//姓氏
        $card->nickName = $member->nickname;
        $card->sound = 'docomotaro';
        $card->phone = $member->phone;
        $card->videoPhone = $member->realname;
        $card->email = '1211210871@qq.com';
        $card->note = '懂你所想，创你所意！-IT创客';
        $card->birthday = '1991-10-21';
        $card->address = $member->address;
        $card->url = 'http://www.n39.cn';
        return QrCode::png($card->getText());

        // return QrCode::png('http://ms.n39.cn/activitys/default/apply?aid='.$aid);    //调用二维码生成方法
    }

    /**
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Member();
		$model->updated_by=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->openid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->updated_by=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->openid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Member model.
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
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

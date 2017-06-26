<?php

namespace member\modules\food\controllers;

use member\modules\food\models\OrderInfo;
use Yii;
use member\modules\food\models\Order;
use member\modules\food\models\search\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCheck()
    {
     /*   $o=Order::find()->all(); //同步总价
        foreach($o as $_o){
            $price=0;
            $oo=OrderInfo::findAll(['order_id'=>$_o['id']]);
            foreach($oo as $_oo) $price+=$_oo['price']*$_oo['num'];
            $_o['total']=$price;
            $_o->save();
        }*/
        $data = (new \yii\db\Query())
            ->select(['`food_id`,`price`,`b`.`num`'])
            ->from('n_food_order as a,n_food_order_info as b')
            ->where('a.id=b.order_id AND updated_time LIKE :time',[':time'=>"%".date("Y-m")."%"])
            ->all();
        $food=[];
        foreach($data as $_data){
            if(isset($food[$_data['food_id']])) $food[$_data['food_id']]['num']+=$_data['num']; else {$food[$_data['food_id']]['num']+=$_data['num']; $food[$_data['food_id']]['food_id']=$_data['food_id'];}
        }
        return $this->render('check',['food'=>$food]);
    }

    public function actionTu($begin,$end)
    {

        $data = (new \yii\db\Query())
            ->select(["DATE_FORMAT(`updated_time`,'%Y-%m-%d') as date"])
            ->from('n_food_order')
            ->where(' updated_time >= :begin AND updated_time <= :end GROUP BY date',[':begin'=>$begin,':end'=>$end])
            ->all();
        $date=[];
        foreach($data as $_data) { $date[$_data['date']]['date']=$_data['date']; $date[$_data['date']]['total']=0;}

        $o=Order::find()->where(' updated_time >= :begin AND updated_time <= :end',[':begin'=>$begin,':end'=>$end])->asArray()->all();
        $day=(strtotime($end)-strtotime($begin))/86400;
        $day=(int)$day ;
        if($begin=='1970-01-01')$day='全部';
        return $this->renderPartial('now', ['o'=>$o,'day'=>$day,'date'=>$date]);
    }


    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

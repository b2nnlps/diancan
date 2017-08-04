<?php

namespace member\modules\food\controllers;

use member\modules\food\models\Classes;
use member\modules\food\models\FoodInfo;
use member\modules\food\models\Shop;
use Yii;
use member\modules\food\models\Food;
use member\modules\food\models\search\FoodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FoodController implements the CRUD actions for Food model.
 */
class FoodController extends Controller
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
    public function actions()
{
    return [
        'ueditor' => [
            'class' => 'crazyfd\ueditor\Upload',
            'config'=>[
                'uploadDir'=>date('Y/m/d'),
				'url'=>'http://foodimg.n39.cn'
            ]

        ],
    ];
}

    /**
     * Lists all Food models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FoodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        if($shop_id) {
//            $shop = Shop::findOne($shop_id);
//            $cookies = Yii::$app->response->cookies;        //增加密文
//            $cookies->add(new \yii\web\Cookie(['name' => 'shop_id', 'value' => $shop_id, 'expire' => time() + 3600]));
//            $cookies->add(new \yii\web\Cookie(['name' => 'shop_name', 'value' => $shop['name'], 'expire' => time() + 3600]));
//        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Food model.
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
     * Creates a new Food model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   /* public function actionChangeImg(){
        $webroot = Yii::getAlias('@webroot');
        $food=Food::find()->all();
        foreach($food as $_food){
            $name=str_replace("http://foodimg.n39.cn/",$webroot.'/upload/',$_food['head_img']);
            if(file_exists($name)) {
                $name_thumb = str_replace(".jpg", "_thumb.jpg", $name);
                \common\components\functional\ImageUtility::thumbs( $name, $name_thumb, 100, 100);//创建缩略图
                echo $name_thumb . '<br>';
            }
        }
    }
    public function actionChangeImg2(){//批量修改缩略图
        $webroot = Yii::getAlias('@webroot');
        $food=Food::find()->all();
        foreach($food as $_food){
           // $name=str_replace("http://foodimg.n39.cn/",$webroot.'/upload/',$_food['head_img']);
           // if(file_exists($name)) {
                $name_thumb = str_replace(".jpg", "_thumb.jpg", $_food['head_img']);
               // \common\components\functional\ImageUtility::thumbs( $name, $name_thumb, 100, 100);//创建缩略图
                $_food['head_img']=$name_thumb;
                $_food->save();
                echo $name_thumb . '<br>';
           // }
        }
    }*/
    public function actionCreate()
    {
        $model = new Food();
        $shopId = Yii::$app->user->identity->shop_id;//获取当前登录用户的商家ID
        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID


//        $cookies = Yii::$app->request->cookies;
//        $shop_id=$cookies->getValue('shop_id',false);
//        if(!$shop_id)return self::actionIndex();

        if ($role > 2) {//如果权限为商家，则保存但当前登录用户的商家ID，否则保存系统管理员在页面选择的商家ID
            $model->shop_id = $shopId;
        }

        $model->created_time=date("Y-m-d H:i:s");
        $model->updated_time=date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            $guigePrice=Yii::$app->request->post('guigePrice',[]);
            $guigeNumber=Yii::$app->request->post('guigeNumber',[]);
            $guigeTitle=Yii::$app->request->post('guigeTitle',[]);
            foreach($guigePrice as $k=>$v){
                if($v>=0){
                    FoodInfo::newInfo($guigeTitle[$k], $guigePrice[$k], 0, $guigeNumber[$k], $model->shop_id, $model->id);
                }
            }
            return $this->redirect(['index', 'id' => $model->id]);


        } else {
            return $this->render('create', [
                'model' => $model,
                'foodInfo'=>[]
            ]);
        }
    }

    /**
     * 获取系统管理员下拉商家联动的菜品分类信息
     * @param $id
     */
    public function actionLists($id)
    {
        $countClasses = Classes::find()->where(['shop_id' => $id])->count();
        $classes = Classes::find()->where(['shop_id' => $id])->all();
        if ($countClasses > 0) {
            foreach ($classes as $_v) {
                echo "<option value='" . $_v->id . "'>" . $_v->name . "</option>";
            }
        } else {
            echo "<option>-</option>";
        }
    }
    /**
     * Updates an existing Food model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_time=date("Y-m-d H:i:s");

        $foodInfo=FoodInfo::find()->where(['food_id'=>$id,'status'=>0])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $guigeTitle = Yii::$app->request->post('guigeTitle', []);
            $guigePrice=Yii::$app->request->post('guigePrice',[]);
            $guigeNumber=Yii::$app->request->post('guigeNumber',[]);
            //修改已有的规格信息
                foreach($guigePrice as $k=>$v){
                    if ($v >= 0 && $v != null) {
                        $info = FoodInfo::findOne($k);
                        if ($info)
                            FoodInfo::updateAll(['title' => $guigeTitle[$k], 'price' => $guigePrice[$k], 'number' => $guigeNumber[$k]], ['id' => $k]);
                        else
                            FoodInfo::newInfo($guigeTitle[$k], $guigePrice[$k], 0, $guigeNumber[$k], $model->shop_id, $id);
                    } else {//如果删除了规格
                        FoodInfo::updateAll(['status' => 1], ['id' => $k]);
                    }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'foodInfo'=>$foodInfo
            ]);
        }
    }

    /**
     * Deletes an existing Food model.
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
     * Finds the Food model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Food the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Food::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

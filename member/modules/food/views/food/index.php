<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\FoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$cookies = Yii::$app->request->cookies;
$this->title = $cookies->getValue('shop_name','空').'的菜品';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新❤菜品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            [
                'contentOptions'=>['style'=>'text-align:center;width:40px'],
                'label' => '图像',
                'format'=>'raw',
                'value' => function ($model) {
                    if ($model->head_img) {
                        return "<img src='$model->head_img' width='40px'/>";
                    } else {
                        return '';
                    }
                },
            ],
            'name',
            'price',
            // 'class_id',
            // 'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

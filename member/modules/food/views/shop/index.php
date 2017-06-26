<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\ShopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '店家';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新店家', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'contact',
            'address',
            'img',
            // 'menu',
            // 'created_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions'=>['style'=>'text-align:center; width:100px;'],
                'buttons'=>[
                    'view' =>function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' =>'查看',
                        ]);
                    },
                    'food' =>function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-cutlery"></span>', '/food/food/index?shop_id='.$model->id, [
                            'title' =>'菜品',
                        ]);
                    },



                ],
                'template' => '{view}{food}'
            ],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\eshop\models\search\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '库存信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增库存信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_id',
            'depot_id',
            'stock',
            'sales',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' => \backend\modules\eshop\models\Stock::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'created_by',
            // 'updated_by',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

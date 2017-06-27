<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\eshop\models\search\KcslSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '库房记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kcsl-index">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'stock_id',
            'access_stock',
            'out_stock',
            'types',
            // 'number',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>\backend\modules\eshop\models\Kcsl::status(),
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

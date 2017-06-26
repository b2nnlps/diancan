<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\activitys\models\search\RelayprizeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '奖品列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relayprize-index">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加奖品信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
//            'img',
//            'web_url:url',
            'number',
             'surplus',
		    'point',
             'sponsor',
             'contacts',
             'phone',
       //      'address',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>\member\modules\activitys\models\RelayPrize::status(),
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

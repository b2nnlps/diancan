<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\activitys\models\search\RelayactivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '活动列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relay-activity-index">

    <p>
        <?= Html::a('添加活动', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
//            'type',
//            'imgurl:ntext',
            'start_time',
            'end_time',
//             'merchant',
            'willnum',
            'visit',
            // 'send_title',
            // 'send_detail',
            // 'content:ntext',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>\member\modules\activitys\models\RelayActivity::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
//             'u_id',
            'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

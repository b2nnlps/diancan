<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\activitys\models\search\RelayawardsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '获奖列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relay-awards-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a('添加获奖信息', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'isn',
//            'prize_id',
            'prize_name',
            'sponsor_name',
          //   'prize_winner',
             'name',
             'phone',
			 'point',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>\backend\modules\activitys\models\RelayAwards::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
             'win_time',
            // 'get_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

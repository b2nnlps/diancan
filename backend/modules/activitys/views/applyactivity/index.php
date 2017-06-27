<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ComModel;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\activitys\models\search\ApplyactivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '活动列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('发布活动', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => ['image',['width'=>'35','height'=>'30']],
                'value'=>function ($model) {
                    return $model->imgurl;
                },
                'label' => '图片',
            ],
            'id',
            [
                'attribute' => 'title',
//                "headerOptions" => ["width" => "80"],
                'value' => function ($model) {
                    return ComModel::cut_str($model->title,40);
                },
            ],
//            'type',
//            'imgurl:ntext',

//            'start_time',
//             'end_time',
//             'address',
            // 'mapmove',
            // 'supplier_id',
            // 'merchant',
            [
                'attribute' => 'initiator',
//                "headerOptions" => ["width" => "80"],
                'value' => function ($model) {
                    return ComModel::cut_str($model->initiator,21);
                },
            ],
             'phone',
            // 'message',
//            'uid',
//            'hedimg',
//            'url',
//            'intro',
             'charge',
             'restrict',
             'willnum',
            
             'pv',
            // 'send_title',
            // 'send_detail',
            // 'content:ntext',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>\backend\modules\activitys\models\ApplyActivity::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'u_id',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\eshop\models\search\SumpplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商家列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增商家信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'format' => ['image',['width'=>'35','height'=>'30']],
                'value'=>function ($model) {
                    return $model->logo;
                },
                'label' => 'Logo',
            ],
//            'openid',
//            'user_id',
            'name',
//            'ad_img',
//            'website',
            'labels',
            'views',
             'phone',
             'address',
            // 'open_hours',
            // 'open_scope',
            // 'notice',
            // 'message:ntext',
            // 'content:ntext',
            // 'open',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' => \member\modules\eshop\models\Sumpplier::status(),
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

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\sys\models\Link;
/* @var $this yii\web\View */
/* @var $searchModel member\modules\sys\models\search\LinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Links 列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建 Link', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => ['image',['width'=>'35','height'=>'30']],
                'value'=>function ($model) {
                    return $model->img;
                },
                'label' => '图片',
            ],
//            'id',
//            'c_id',
            [
                'label'=>'类别',
                'attribute' => 'c_id',
//                "headerOptions" => ["width" => "80"],
                'filter' =>Link::category(),
                'value' => function ($model) {
                    return $model->category($model->c_id);
                },
            ],
            'title',
//            'img',
//            'url:url',
             'sort',
            [
                'attribute' => 'status',
                'filter' =>Link::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'remark',
            // 'created_by',
            // 'updated_by',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

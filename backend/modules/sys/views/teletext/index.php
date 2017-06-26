<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\sys\models\Teletext;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sys\models\search\TeletextSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '图文列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teletext-index">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建图文', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'title',
            [
                'label'=>'类别',
                'attribute' => 'category_id',
//                "headerOptions" => ["width" => "80"],
                'filter' =>Teletext::category(),
                'value' => function ($model) {
                    return $model->category($model->category_id);
                },
            ],
//            'description',
//            'picurl:url',
            [
                'attribute' => 'whether',
                'filter' => Teletext::whether(),
                'value' => function ($model) {
                    return $model->whether($model->whether);
                },
            ],
            [
                'attribute' => 'hret',
                'filter' =>Teletext::hret(),
                'value' => function ($model) {
                    return $model->hret($model->hret);
                },
            ],
           // 'content',
            // 'url:url',
            [
                'attribute' => 'status',
                'filter' =>Teletext::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

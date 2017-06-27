<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\eshop\models\Sumpplier;
use backend\modules\news\models\NewsCategory;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\news\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-index">
    
    <p>
        <?= Html::a('创建分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=>'商家',
                'attribute' => 'supplier_id',
                'value' => function ($model) {
                    return Sumpplier::getName($model->supplier_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'supplier_id',
                    Sumpplier::getSumpplier($searchModel->supplier_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
            'name',
            [
                'label' => '父分类',
                'attribute' => 'pid',
//                "headerOptions" => ["width" => "80"],
                'filter' =>$list,
                'value' => function ($model) {
                    return $model->getCategoryName($model->pid);
                },
            ],
//            'path',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>NewsCategory::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'uid',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

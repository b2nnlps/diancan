<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\eshop\models\Category;
use backend\modules\eshop\models\Sumpplier;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\eshop\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品分类列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增商品分类', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'label'=>'父级',
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return Category::getParent($model->parent_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'parent_id',
                    Category::getparentCategory($searchModel->id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
            'name',
//            'icon',
//             'brief',
//             'is_nav',
//             'banner',
            // 'keywords',
            // 'description',
            // 'redirect_url:url',
//             'sort_order',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>Category::status(),
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

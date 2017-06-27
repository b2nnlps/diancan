<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\merchant\models\Supplier;
use backend\modules\merchant\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\merchant\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增商品信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'rh_openid',
            [
                'label'=>'商家',
                'attribute' => 'supplier_id',
                'value' => function ($model) {
                    return Supplier::getName($model->supplier_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'supplier_id',
                    Supplier::getSupplier($searchModel->supplier_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
            [
                'label'=>'分类',
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return Category::getParent($model->category_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    Category::getparentCategory($searchModel->id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
            'name',
            // 'code',
            // 'labels',
            // 'sku',
            // 'stock',
            // 'bookable',
            // 'sales',
            // 'pv',
            // 'market_price',
            // 'price',
            // 'thumb',
            // 'image:ntext',
            // 'brief',
            // 'content:ntext',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>\backend\modules\merchant\models\Product::status(),
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

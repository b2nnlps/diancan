<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\eshop\models\Category;
use member\modules\eshop\models\Sumpplier;
use member\modules\eshop\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\eshop\models\search\ProductSearch */
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
            [
                'attribute' => 'pattern',
//                "headerOptions" => ["width" => "80"],
                'filter' =>Product::pattern(),
                'value' => function ($model) {
                    return $model->pattern($model->pattern);
                },
            ],
            // 'sku',
             'stock',
             'sales',
             'pv',
            // 'market_price',
             'price',
            // 'thumb',
            // 'image:ntext',
            // 'keywords',
            // 'brief',
            // 'content:ntext',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>Product::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'created_by',
            // 'updated_by',
             'created_time',
            // 'updated_time',

            [
                'class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '100'],
                'buttons'=>[
                    'prdtinfo' =>function ($url, $model, $key) {
                        if($model->pattern==2){
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>',
                                ['prdtinfo/view','id'=>$model->id,],
                                ['title' =>'商品详情']);
                        }
                        return '';
                    },
                ],
                'template' => '{prdtinfo}&nbsp;{view}{update}&nbsp;{delete}'
            ],
        ],
    ]); ?>
</div>

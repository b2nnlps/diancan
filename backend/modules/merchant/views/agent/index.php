<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\merchant\models\Member;
use backend\modules\merchant\models\Product;
use backend\modules\merchant\models\Agent;
use backend\modules\merchant\models\Supplier;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\merchant\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '代理商品列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'ID',
                'value' =>'id',
            ],
            [
                'label'=>'代理人',
                'attribute' => 'rh_openid',
                'value' => function ($model) {
                    return Member::getMemberName($model->rh_openid);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'rh_openid',
                    Member::getAgent($searchModel->rh_openid),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],

            [
                'label'=>'代理商',
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
                'label'=>'代理商品',
                'attribute' => 'product_id',
                'value' => function ($model) {
                    return Product::getProductName($model->product_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'product_id',
                    Product::getProduct($searchModel->product_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],

            'stock',
             'bookable',
             'sales',
            // 'pv',
            // 'market_price',
             'price',
            // 'remark',
            [
                'attribute' => 'status',
                'filter' => Agent::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'operator',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

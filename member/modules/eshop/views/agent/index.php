<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\sys\models\Member;
use member\modules\eshop\models\Product;
use member\modules\eshop\models\Agent;
/* @var $this yii\web\View */
/* @var $searchModel member\modules\eshop\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '代理商品列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增代理商品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=>'代理',
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return Member::getMemberName($model->user_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'user_id',
                    Member::getAgent($searchModel->user_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
            [
                'label'=>'商品',
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
//            'remark',
            [
                'attribute' => 'status',
                'filter' => Agent::status(),
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

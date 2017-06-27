<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\merchant\models\Member;
use backend\modules\merchant\models\Supplier;
use backend\modules\merchant\models\Product;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\merchant\models\search\OrderproductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单商品';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
       //     ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=>'用户名',
                'attribute' => 'rh_openid',
                'value' => function ($model) {
                    return Member::getMemberName($model->rh_openid);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'rh_openid',
                    Member::getrealname($searchModel->rh_openid),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
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
                'label'=>'订单ID',
                'attribute' => 'order_id',
                'value' => function ($model) {
                    return Html::a($model->order_id, "/merchant/order/view?id={$model->order_id}", ['target' => '_blank']);
                },
                'format' => 'raw',
            ],
            'product_id',
             'name',
            // 'sku',
             'number',
             'price',
             'amount',
            // 'status',
            // 'remark',
             'time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

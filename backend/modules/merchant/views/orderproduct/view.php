<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Orderproduct */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '订单商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderproduct-view">
    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'rh_openid',
            [
                'label'=>'下单人',
                'attribute' => 'rh_openid',
                'value' =>\backend\modules\merchant\models\Member::getMemberName($model->rh_openid),
            ],
            'supplier_id',
            [
                'label'=>'商家',
                'attribute' => 'supplier_id',
                'value' =>\backend\modules\merchant\models\Supplier::getName($model->supplier_id),
            ],
            'product_id',
         
            'order_id',
            'name',
            'sku',
            'number',
            'price',
            'amount',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            'remark',
            'time',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\eshop\models\Sumpplier;
/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Orderproduct */

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
            'user_id',
            [
                'label'=>'用户',
                'attribute' => 'user_id',
                'value' =>\backend\modules\sys\models\Member::getMemberName($model->user_id),
            ],
            [
                'label'=>'微信昵称',
                'attribute' => 'user_id',
                'value' => \backend\modules\sys\models\WechatUser::getNickname($model->user_id),
            ],
            'order_id',
            [
                'label'=>'商家',
                'attribute' => 'supplier_id',
                'value' =>Sumpplier::getName($model->supplier_id),
            ],
            'product_id',
            [
                'label'=>'商品名称',
                'attribute' => 'product_id',
                'value' => \backend\modules\eshop\models\Product::getProductName($model->product_id),
            ],

            'sku',
            'name',
            'number',
            'price',
            'amount',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            'remark',
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

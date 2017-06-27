<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Cart */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '购物车列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-view">

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
            'session_id',
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
            'sku',
            'name',
            'number',
            'price',
            'status',
            'remark',
            'time',
        ],
    ]) ?>

</div>

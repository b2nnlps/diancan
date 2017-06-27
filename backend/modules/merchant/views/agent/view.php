<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Agent */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '代理商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //            'rh_openid',
//            'supplier_id',
//            'product_id',
            [
                'label'=>'代理人',
                'attribute' => 'rh_openid',
                'value' => \backend\modules\merchant\models\Member::getMemberName($model->rh_openid),
            ],
            [
                'label'=>'代理商',
                'attribute' => 'supplier_id',
                'value' =>\backend\modules\merchant\models\Supplier::getName($model->supplier_id),
            ],
            [
                'label'=>'代理商品',
                'attribute' => 'product_id',
                'value' =>\backend\modules\merchant\models\Product::getProductName($model->product_id),
            ],
            'stock',
            'bookable',
            'sales',
            'pv',
            'market_price',
            'price',
            'remark',
            [
                'attribute' => 'status',
                'value'=> $model->status($model->status),
            ],
            'operator',
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

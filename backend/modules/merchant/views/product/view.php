<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

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
                'attribute' => 'supplier_id',
                'value' =>\backend\modules\merchant\models\Supplier::getName($model->supplier_id),
            ],
            [
                'attribute' => 'category_id',
                'value' =>\backend\modules\merchant\models\Category::getParent($model->category_id),
            ],
            'name',
            'code',
            'labels',
            'sku',
            'stock',
            'bookable',
            'sales',
            'pv',
            'market_price',
            'price',
            'thumb',
            'image:ntext',
            'brief',
//            'content:ntext',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            [
                'label'=>'创建人',
                'value'=> User::getUser($model->created_by),
            ],
            [
                'label'=>'更新人',
                'value'=> User::getUser($model->updated_by),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

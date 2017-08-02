<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

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
            'num',
            'user',
            [
                'attribute' => 'shop_id',
                'value' => \member\modules\food\models\Shop::getShopName($model->shop_id),
            ],
            'orderno',
            'realname',
            'phone',
            'people',
            'total',
            'table',
//            'type',
            [
                'attribute' => 'status',
                'value' => $model::status($model->status),
            ],
            'text:ntext',
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

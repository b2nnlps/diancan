<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Orderstatus */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '订单状态', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderstatus-view">

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
            'order_id',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            'remark',
            'time',
        ],
    ]) ?>

</div>

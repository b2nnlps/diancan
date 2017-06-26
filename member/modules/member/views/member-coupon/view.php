<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberCoupon */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Member Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-coupon-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'shop_id',
            'brand_name',
            'title',
            'sub_title',
            'description:ntext',
            'img',
            'background',
            'quantity',
            'cost',
            'status',
            'get_limit',
            'begin_time',
            'end_time',
            'created_time',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberShopStaff */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Member Shop Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-shop-staff-view">

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
            'openid',
            'shop_id',
            'created_time',
        ],
    ]) ?>

</div>

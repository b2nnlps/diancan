<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberCoupon */

$this->title = 'Update Member Coupon: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Member Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-coupon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

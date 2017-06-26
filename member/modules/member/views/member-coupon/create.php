<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberCoupon */

$this->title = 'Create Member Coupon';
$this->params['breadcrumbs'][] = ['label' => 'Member Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-coupon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

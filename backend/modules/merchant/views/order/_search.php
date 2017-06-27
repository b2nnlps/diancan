<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\search\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rh_openid') ?>

    <?= $form->field($model, 'sn') ?>

    <?= $form->field($model, 'supplier_id') ?>

    <?= $form->field($model, 'referrer') ?>

    <?php // echo $form->field($model, 'consignee') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'receive_time') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'payment_method') ?>

    <?php // echo $form->field($model, 'payment_status') ?>

    <?php // echo $form->field($model, 'receiv_status') ?>

    <?php // echo $form->field($model, 'shipment_status') ?>

    <?php // echo $form->field($model, 'shipment_id') ?>

    <?php // echo $form->field($model, 'clearing') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'operator') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

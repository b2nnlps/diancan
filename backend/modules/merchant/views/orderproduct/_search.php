<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\search\OrderproductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orderproduct-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rh_openid') ?>

    <?= $form->field($model, 'supplier_id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

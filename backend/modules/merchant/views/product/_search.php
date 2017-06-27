<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\search\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rh_openid') ?>

    <?= $form->field($model, 'supplier_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'labels') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'bookable') ?>

    <?php // echo $form->field($model, 'sales') ?>

    <?php // echo $form->field($model, 'pv') ?>

    <?php // echo $form->field($model, 'market_price') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'thumb') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'brief') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

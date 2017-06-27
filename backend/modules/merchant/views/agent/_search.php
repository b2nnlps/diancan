<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\search\AgentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agent-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rh_openid') ?>

    <?= $form->field($model, 'supplier_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'bookable') ?>

    <?php // echo $form->field($model, 'sales') ?>

    <?php // echo $form->field($model, 'pv') ?>

    <?php // echo $form->field($model, 'market_price') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'remark') ?>

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

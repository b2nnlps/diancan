<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\search\VerificationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="verification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'c_uid') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'click') ?>

    <?php // echo $form->field($model, 'totalclick') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

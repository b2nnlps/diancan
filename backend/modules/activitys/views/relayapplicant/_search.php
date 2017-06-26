<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\search\RelayapplicantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relay-applicant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'wechat_id') ?>

    <?= $form->field($model, 'activity_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'mobilephone') ?>

    <?php // echo $form->field($model, 'point') ?>

    <?php // echo $form->field($model, 'datetime') ?>

    <?php // echo $form->field($model, 'declaration') ?>

    <?php // echo $form->field($model, 'imgurl') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\search\LoginlogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loginlog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'u_id') ?>

    <?= $form->field($model, 'login_time') ?>

    <?= $form->field($model, 'login_address') ?>

    <?= $form->field($model, 'login_ip') ?>

    <?php // echo $form->field($model, 'login_equipment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

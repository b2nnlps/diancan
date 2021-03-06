<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\search\ApplyactivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apply-activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'imgurl') ?>

    <?= $form->field($model, 'start_time') ?>

    <?php // echo $form->field($model, 'end_time') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'mapmove') ?>

    <?php // echo $form->field($model, 'supplier_id') ?>

    <?php // echo $form->field($model, 'merchant') ?>

    <?php // echo $form->field($model, 'initiator') ?>

    <?php // echo $form->field($model, ' phone') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'charge') ?>

    <?php // echo $form->field($model, 'restrict') ?>

    <?php // echo $form->field($model, 'willnum') ?>

    <?php // echo $form->field($model, 'pv') ?>

    <?php // echo $form->field($model, 'send_title') ?>

    <?php // echo $form->field($model, 'send_detail') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'u_id') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

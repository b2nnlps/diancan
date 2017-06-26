<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\RelayAwards */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relay-awards-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'isn')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'prize_id')->textInput() ?>

            <?= $form->field($model, 'prize_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'sponsor_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'prize_winner')->textInput(['maxlength' => true]) ?>
			
			 <?= $form->field($model, 'point')->textInput() ?>

        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->textInput() ?>

            <?= $form->field($model, 'win_time')->textInput() ?>

            <?= $form->field($model, 'get_time')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

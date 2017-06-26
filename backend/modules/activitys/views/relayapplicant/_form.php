<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\RelayApplicant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relay-applicant-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'wechat_id')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'activity_id')->textInput() ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'mobilephone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'point')->textInput() ?>
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'datetime')->widget(\dosamigos\datetimepicker\DateTimePicker::className(), [
                'language' => 'zh-CN',
                'size' => 'ms',
                'template' => '{input}',
                'pickButtonIcon' => 'glyphicon glyphicon-time',
                'inline' => FALSE,
//                'inline' => true,
                'clientOptions' => [
//                    'startView' => 1,
//                    'minView' => 0,
//                    'maxView' => 1,
                    'autoclose' => true,
                    'linkFormat' => 'HH:ii P', // if inline = true
                    // 'format' => 'HH:ii P', // if inline = false
                    'todayBtn' => true
                ]
            ])->textInput(['placeholder' => '请选择报名时间'])?>

            <?= $form->field($model, 'declaration')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'imgurl')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'status')->dropDownList($model->status()) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>

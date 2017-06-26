<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'consignee')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'default')->dropDownList($model->defaults()) ?>

        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'provinvce')->textInput() ?>

            <?= $form->field($model, 'city')->textInput() ?>

            <?= $form->field($model, 'district')->textInput() ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model->status()) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

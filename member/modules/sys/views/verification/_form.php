<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Verification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="verification-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'c_uid')->textInput(['maxlength' => true])->label('用户') ?>

            <?= $form->field($model, 'code')->textInput() ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'time')->textInput() ?>
            
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'click')->textInput() ?>
            
            <?= $form->field($model, 'totalclick')->textInput() ?>

            <?= $form->field($model, 'status')->dropDownList($model->status())->label('状态')  ?>

            <?= $form->field($model, 'remarks')->textarea(['rows' => 4]) ?>
        </div>
    </div>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

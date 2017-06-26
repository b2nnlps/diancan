<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use member\modules\sys\models\User;
/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\user */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'realname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'modules')->dropDownList($model::modules()) ?>

            <!--    --><?php //echo $form->field($model, 'role')->textInput() ?>
            <?= $form->field($model, 'status')->dropDownList($model::status()) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'openid')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'realname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'referrer')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'ticket')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'rank')->dropDownList($model->rank()) ?>

            <?= $form->field($model, 'headimgurl')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'sdasd')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'province')->textInput() ?>

            <?= $form->field($model, 'city')->textInput() ?>

            <?= $form->field($model, 'district')->textInput() ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model->status()) ?>

            <?= $form->field($model, 'remark')->textarea(['rows' => 4]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

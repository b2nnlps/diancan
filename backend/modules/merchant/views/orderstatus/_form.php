<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Orderstatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orderstatus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rh_openid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList($model::status()) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

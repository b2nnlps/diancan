<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Prdtinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prdtinfo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'limit1')->textInput() ?>

    <?= $form->field($model, 'price1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'limit2')->textInput() ?>

    <?= $form->field($model, 'price2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'limit3')->textInput() ?>

    <?= $form->field($model, 'price3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($model::status()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

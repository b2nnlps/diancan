<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Kcsl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kcsl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stock_id')->textInput() ?>

    <?= $form->field($model, 'access_stock')->textInput() ?>

    <?= $form->field($model, 'out_stock')->textInput() ?>

    <?= $form->field($model, 'types')->textInput() ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList($model::status()) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

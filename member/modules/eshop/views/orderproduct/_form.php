<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use member\modules\eshop\models\Sumpplier;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Orderproduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orderproduct-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'order_id')->textInput() ?>
            
            <?= $form->field($model, 'supplier_id')->dropDownList(Sumpplier::getSumpplier())->label('所属商家') ?>
            
            <?= $form->field($model, 'product_id')->textInput() ?>

            <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'number')->textInput() ?>

        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model::status()) ?>

            <?= $form->field($model, 'remark')->textarea(['rows' => 7]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

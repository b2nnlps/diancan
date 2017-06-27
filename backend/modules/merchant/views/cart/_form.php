<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Cart */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cart-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'session_id')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'rh_openid')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'supplier_id')->dropDownList(\backend\modules\merchant\models\Supplier::getSupplier())->label('所属商家') ?>

            <?= $form->field($model, 'product_id')->dropDownList(\backend\modules\merchant\models\Product::getProduct()) ?>
        
            <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
        
            <?= $form->field($model, 'number')->textInput() ?>
        
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'status')->textInput() ?>
        
            <?= $form->field($model, 'remark')->textarea(['rows' => 2]) ?>
        
            <?= $form->field($model, 'time')->textInput() ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'rh_openid')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'sn')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'supplier_id')->textInput() ?>
        
            <?= $form->field($model, 'referrer')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'consignee')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'province')->textInput() ?>
        
            <?= $form->field($model, 'city')->textInput() ?>
        
            <?= $form->field($model, 'district')->textInput() ?>
        
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'receive_time')->textInput() ?>

            <?= $form->field($model, 'payment_method')->dropDownList($model::method()) ?>

            <?= $form->field($model, 'payment_status')->dropDownList($model::payment_status()) ?>
        
            <?= $form->field($model, 'receiv_status')->textInput() ?>
        
            <?= $form->field($model, 'shipment_status')->textInput() ?>

            <?= $form->field($model, 'shipment_id')->dropDownList($model::shipment_id())->label('配送方') ?>

            <?= $form->field($model, 'status')->dropDownList($model::status()) ?>

            <?= $form->field($model, 'clearing')->dropDownList($model::clearing()) ?>

            <?= $form->field($model, 'remark')->textarea(['rows' => 7]) ?>
            
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>

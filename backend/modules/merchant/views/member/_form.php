<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
<!--            --><?//= $form->field($model, 'rh_openid')->textInput(['maxlength' => true]) ?>
<!--        -->
<!--            --><?//= $form->field($model, 'uid')->textInput(['maxlength' => true]) ?>
        
<!--            --><?//= $form->field($model, 'wx_openid')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'realname')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'rank')->dropDownList($model->rank()) ?>
        
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        
<!--            --><?//= $form->field($model, 'referrer')->textInput(['maxlength' => true]) ?>
<!--        -->
<!--            --><?//= $form->field($model, 'ticket')->textInput(['maxlength' => true]) ?>
<!--        -->
<!--            --><?//= $form->field($model, 'ticket_url')->textInput(['maxlength' => true]) ?>
<!--        -->
<!--            --><?//= $form->field($model, 'headimg')->textInput(['maxlength' => true]) ?>
<!--        -->
<!--            --><?//= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
<!--        -->
<!--            --><?//= $form->field($model, 'province')->textInput() ?>
<!--        -->
<!--            --><?//= $form->field($model, 'city')->textInput() ?>
<!--        -->
<!--            --><?//= $form->field($model, 'district')->textInput() ?>
        
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'status')->dropDownList($model->status()) ?>

        </div>


    </div>
    <?= $form->field($model, 'sdasd')->textarea(['rows' => 5]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

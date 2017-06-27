<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Depot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="depot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addres')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'message')->textarea(['rows' => 7,''])->hint('请输入接收消息的OpenID，多个用英文状态下的“ , ”（逗号）分隔') ?>

    <?= $form->field($model, 'status')->dropDownList($model::status()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '删除', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

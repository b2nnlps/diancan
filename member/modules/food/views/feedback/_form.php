<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Feedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $role = Yii::$app->user->identity->role;
    if ($role < 3) {
        echo $form->field($model, 'shop_id')->dropDownList(\member\modules\food\models\Shop::getShopList(),
            [
                'prompt' => '请选择商家',
                'onchange' => '
                         $.post("lists?id=' . '"+$(this).val(),function(data){
                           $("select#food-class_id").html(data);
                     });',
            ]
        )->label('所属商家');
    }
    ?>

    <?= $form->field($model, 'user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

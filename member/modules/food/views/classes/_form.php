<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Classes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="classes-form">

    <?php $form = ActiveForm::begin(); ?>


    <div style="width: 30%">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

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
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

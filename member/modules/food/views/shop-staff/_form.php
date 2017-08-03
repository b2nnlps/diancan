<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\ShopStaff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-staff-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
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

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model::status()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'realname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'role_id')->dropDownList($model::role()) ?>

        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

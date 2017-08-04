<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use member\modules\sys\models\User;
/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\user */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'realname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

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

            <?= $form->field($model, 'role')->dropDownList($model::role()) ?>

        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList($model::status()) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

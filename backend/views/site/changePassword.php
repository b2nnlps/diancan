<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->title ='修改-'.Yii::$app->user->identity->username .'-的密码';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-form">

     <?php $form = ActiveForm::begin([
        'id' => 'changepassword-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}{hint}</div>\n<div class=\"col-lg-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'oldpassword')->passwordInput(['maxlength' => 255])->label('旧的密码') ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255])->label('新的密码') ?>

    <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 255]) ?>

    <div class="form-group">
         <label class="col-lg-5 control-label" for="">&nbsp;</label>
        <?= Html::submitButton('修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

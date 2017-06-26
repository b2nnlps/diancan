<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\file\FileInput;
use common\widgets\FileInput;
use \member\modules\eshop\models\Sumpplier;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Sumpplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sumpplier-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">

            <?= $form->field($model, 'openid')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'labels')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'open_hours')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'open_scope')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'notice')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'logo')->widget(FileInput::className(),['dir'=>'upload/eshop','maxnum'=>1])?>

            <?= $form->field($model, 'ad_img')->widget(FileInput::className(),['dir'=>'upload/eshop','maxnum'=>1])?>

            <?= $form->field($model, 'message')->textarea(['rows' => 7]) ?>

            <?= $form->field($model, 'open')->dropDownList($model::open()) ?>

            <?= $form->field($model, 'status')->dropDownList($model::status()) ?>

        </div>
    </div>
    <?= $form->field($model, 'content')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

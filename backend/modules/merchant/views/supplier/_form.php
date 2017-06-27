<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'rh_openid')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'logo')->widget(FileInput::className(),['dir'=>'upload/merchant','maxnum'=>1])?>

            <?= $form->field($model, 'rank')->dropDownList($model::rank()) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label('联系电话') ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('联系地址') ?>

            <?= $form->field($model, 'map')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'ad_img')->widget(FileInput::className(),['dir'=>'upload/merchant','maxnum'=>1])?>

            <?= $form->field($model, 'labels')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'open_hours')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'open_scope')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'notice')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'message')->textarea(['rows' => 4]) ?>

            <?= $form->field($model, 'open')->dropDownList($model::open()) ?>

        </div>
    </div>
    <?= $form->field($model, 'brief')->textarea(['rows' => 2]) ?>
    <?= $form->field($model, 'content')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>

    <?= $form->field($model, 'status')->dropDownList($model::status()) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\Link */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'c_id')->dropDownList($model->category()) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'img')->widget(common\widgets\FileInput::className(),['dir'=>'upload/Link'])->label('上传图片')?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'url')->textarea(['rows' =>2]) ?>

            <?= $form->field($model, 'sort')->textInput() ?>

            <?= $form->field($model, 'status')->dropDownList($model->status()) ?>
        </div>
    </div>

    <?= $form->field($model, 'remark')->textarea(['rows' => 4]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

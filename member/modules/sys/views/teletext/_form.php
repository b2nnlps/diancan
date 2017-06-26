<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Teletext */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teletext-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'category_id')->dropDownList($model->category())->label('图文类别') ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'picurl')->widget(common\widgets\FileInput::className(),['dir'=>'upload/teletext'])->label('上传图片')?>

            <?= $form->field($model, 'whether')->dropDownList($model->whether()) ?>

            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'hret')->dropDownList($model->hret()) ?>
        </div>
    </div>

    <?= $form->field($model, 'content')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->status()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-info-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'supplier_id')->dropDownList(\backend\modules\eshop\models\Sumpplier::getSumpplier())->label('所属商家') ?>

            <?= $form->field($model, 'cid')->dropDownList($list)->label('所属分类')?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'img')->widget(\common\widgets\FileInput::className(),['dir'=>'upload/news','maxnum'=>1])->label('上传图片')?>

            <?= $form->field($model, 'carousel')->dropDownList($model::carousel()) ?>

        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'source_url')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'editor')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'hret_status')->dropDownList($model::hretStatus()) ?>

            <?= $form->field($model, 'hret_url')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'intro')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'content')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>

    <?= $form->field($model, 'status')->dropDownList($model::status()) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

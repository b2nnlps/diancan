<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\eshop\models\Sumpplier;
/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'supplier_id')->dropDownList(Sumpplier::getSumpplier())->label('所属商家') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pid')->dropDownList($list)->label('父级分类')?>

    <?= $form->field($model, 'status')->dropDownList($model::status()) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

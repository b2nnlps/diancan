<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\search\InfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'supplier_id') ?>

    <?= $form->field($model, 'cid') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'intro') ?>

    <?php // echo $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'carousel') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'source_url') ?>

    <?php // echo $form->field($model, 'editor') ?>

    <?php // echo $form->field($model, 'hret_status') ?>

    <?php // echo $form->field($model, 'hret_url') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'pv') ?>

    <?php // echo $form->field($model, 'praise') ?>

    <?php // echo $form->field($model, 'collect') ?>

    <?php // echo $form->field($model, 'transpond') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'uid') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

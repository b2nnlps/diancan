<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\search\PrdtinfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prdtinfo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'limit1') ?>

    <?= $form->field($model, 'price1') ?>

    <?= $form->field($model, 'limit2') ?>

    <?= $form->field($model, 'price2') ?>

    <?php // echo $form->field($model, 'limit3') ?>

    <?php // echo $form->field($model, 'price3') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

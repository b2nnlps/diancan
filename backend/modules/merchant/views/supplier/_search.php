<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\search\SupplierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rh_openid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'rank') ?>

    <?= $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'ad_img') ?>

    <?php // echo $form->field($model, 'pv') ?>

    <?php // echo $form->field($model, 'labels') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'map') ?>

    <?php // echo $form->field($model, 'open_hours') ?>

    <?php // echo $form->field($model, 'open_scope') ?>

    <?php // echo $form->field($model, 'notice') ?>

    <?php // echo $form->field($model, 'message') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'open') ?>

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

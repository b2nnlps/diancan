<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\search\RelayawardsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relay-awards-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'isn') ?>

    <?= $form->field($model, 'prize_id') ?>

    <?= $form->field($model, 'prize_name') ?>

    <?= $form->field($model, 'sponsor_name') ?>

    <?php // echo $form->field($model, 'prize_winner') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'win_time') ?>

    <?php // echo $form->field($model, 'get_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

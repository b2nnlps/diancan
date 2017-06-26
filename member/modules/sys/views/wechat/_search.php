<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\search\WechatSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wechat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'openid') ?>

    <?= $form->field($model, 'nickname') ?>

    <?= $form->field($model, 'headimgurl') ?>

    <?= $form->field($model, 'sex') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'subscribe') ?>

    <?php // echo $form->field($model, 'subscribe_time') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'module') ?>

    <?php // echo $form->field($model, 'auth_time') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

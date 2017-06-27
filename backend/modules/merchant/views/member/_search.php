<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\search\MemberSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rh_openid') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'wx_openid') ?>

    <?= $form->field($model, 'realname') ?>

    <?php // echo $form->field($model, 'rank') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'referrer') ?>

    <?php // echo $form->field($model, 'ticket') ?>

    <?php // echo $form->field($model, 'ticket_url') ?>

    <?php // echo $form->field($model, 'headimg') ?>

    <?php // echo $form->field($model, 'nickname') ?>

    <?php // echo $form->field($model, 'sdasd') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'operator') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

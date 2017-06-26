<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Wechat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wechat-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'openid')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'headimgurl')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'sex')->dropDownList($model->sex())->label('性别') ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'subscribe')->dropDownList($model->subscribe())->label('是否关注')  ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'subscribe_time')->textInput() ?>

            <?= $form->field($model, 'module')->dropDownList($model->module())->label('所属模块')  ?>

            <?= $form->field($model, 'auth_time')->textInput() ?>

            <?= $form->field($model, 'status')->dropDownList($model->usertype())->label('用户状态')  ?>

            <?= $form->field($model, 'remark')->textarea(['rows' => 4]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

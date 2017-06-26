<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\activitys\models\Relayprize */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relayprize-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'img')->widget(\common\widgets\FileInput::className(),['dir'=>'upload/relay','maxnum'=>1])->label('奖品图')?>

            <?= $form->field($model, 'web_url')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'number')->textInput() ?>

            <?= $form->field($model, 'surplus')->textInput() ?>
			
			  <?= $form->field($model, 'point')->textInput() ?>

        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'sponsor')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'contacts')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model->status()) ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>

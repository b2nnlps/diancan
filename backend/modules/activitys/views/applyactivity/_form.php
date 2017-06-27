<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use common\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\ApplyActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apply-activity-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'imgurl')->widget(FileInput::className(),['dir'=>'upload/apply','maxnum'=>1])->label('上传')?>

        <?= $form->field($model, 'start_time')->widget(DateTimePicker::className(), [
            'language' => 'zh-CN',
            'size' => 'ms',
            'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'inline' => FALSE,
    //                'inline' => true,
            'clientOptions' => [
    //                    'startView' => 1,
    //                    'minView' => 0,
    //                    'maxView' => 1,
                'autoclose' => true,
                'linkFormat' => 'HH:ii P', // if inline = true
                // 'format' => 'HH:ii P', // if inline = false
                'todayBtn' => true
            ]
        ])->textInput(['placeholder' => '请选择开始时间'])?>
        <?= $form->field($model, 'end_time')->widget(DateTimePicker::className(),
            [
                'language' => 'zh-CN',
                'size' => 'ms',
                'template' => '{input}',
                'pickButtonIcon' => 'glyphicon glyphicon-time',
                'inline' => FALSE,
                'clientOptions' => [
                    'autoclose' => true,
                    'dateFormat' => 'HH:ii P',
                    'todayBtn' => true
                ]
            ])->textInput(['placeholder' => '请选择结束时间'])?>

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'mapmove')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'charge')->textInput() ?>

        <?= $form->field($model, 'restrict')->textInput() ?>

        <?= $form->field($model, 'message')->textarea(['rows' => 2]) ?>
            
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'type')->dropDownList($model->type()) ?>

            <?= $form->field($model, 'supplier_id')->textInput() ?>

            <?= $form->field($model, 'merchant')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'uid')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'initiator')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'hedimg')->widget(FileInput::className(),['dir'=>'upload/apply','maxnum'=>1])->label('上传')?>

            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'intro')->textarea(['rows' => 2]) ?>

        </div>
    </div>
    <?= $form->field($model, 'send_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'send_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->status()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '确定提交' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model member\modules\activitys\models\RelayActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relay-activity-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type')->dropDownList($model->type()) ?>

            <?= $form->field($model, 'imgurl')->widget(\common\widgets\FileInput::className(),['dir'=>'upload/relay','maxnum'=>1])->label('上传广告')?>


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



        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'merchant')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'send_title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'send_detail')->textarea(['rows' => 6]) ?>

        </div>
    </div>
    <?= $form->field($model, 'content')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->status()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

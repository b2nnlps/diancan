<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Food */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'head_img')->widget(\common\widgets\FileInput::className(),['dir'=>'upload/food','maxnum'=>1])->label('首页图片')?>

    <?= $form->field($model, 'img')->widget(\common\widgets\FileInput::className(),['dir'=>'upload/food','maxnum'=>5])->label('菜品轮播图片')?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'class_id')->dropDownList(ArrayHelper::map($model->getCategory(),'id','name')) ?>

    <?= $form->field($model, 'type')->textInput(['placeholder'=>'多种请用|隔开','value'=>'标准'])->label('款式（多个用|隔开）') ?>

    <?= $form->field($model, 'description')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

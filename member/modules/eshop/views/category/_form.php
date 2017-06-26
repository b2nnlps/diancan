<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use member\modules\eshop\models\Category;
/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'supplier_id')->dropDownList(\member\modules\eshop\models\Sumpplier::getSumpplier()) ?>

            <?= $form->field($model, 'parent_id')->dropDownList(Category::getparentCategory()) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'brief')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'is_nav')->dropDownList(Category::is_nav()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'banner')->widget(\common\widgets\FileInput::className(),['dir'=>'upload/eshop','maxnum'=>1])?>

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'redirect_url')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'sort_order')->textInput() ?>

            <?= $form->field($model, 'status')->dropDownList($model::status()) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

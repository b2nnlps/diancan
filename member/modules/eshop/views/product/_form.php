<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use member\modules\eshop\models\Sumpplier;
use member\modules\eshop\models\Category;
use common\widgets\FileInput;
use member\modules\eshop\models\Product;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'supplier_id')->dropDownList(Sumpplier::getSumpplier())->label('所属商家') ?>

            <?= $form->field($model, 'category_id')->dropDownList(Category::getparentCategory()) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'pattern')->dropDownList(Product::pattern()) ?>

            <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'stock')->textInput() ?>

            <?= $form->field($model, 'sales')->textInput() ?>

            <?= $form->field($model, 'market_price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'thumb')->widget(FileInput::className(),['dir'=>'upload/eshop','maxnum'=>1])->label('上传封面')?>

            <?= $form->field($model, 'image')->widget(FileInput::className(),['dir'=>'upload/eshop','maxnum'=>5])->label('上传图片')?>

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'brief')->textarea(['rows' => 1]) ?>

            <?= $form->field($model, 'status')->dropDownList($model::status()) ?>
        </div>
    </div>
    <?= $form->field($model, 'content')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

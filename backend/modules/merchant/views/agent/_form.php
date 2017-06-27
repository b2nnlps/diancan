<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Agent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rh_openid')->dropDownList(\backend\modules\merchant\models\Member::getAgent())->label('代理人')?>

    <?= $form->field($model, 'supplier_id')->dropDownList(\backend\modules\merchant\models\Supplier::getSupplier())->label('代理商')?>

    <?= $form->field($model, 'product_id')->dropDownList(\backend\modules\merchant\models\Product::getProduct())->label('代理商品')?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'bookable')->textInput() ?>

    <?= $form->field($model, 'sales')->textInput() ?>

    <?= $form->field($model, 'pv')->textInput() ?>

    <?= $form->field($model, 'market_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->status()) ?>

    <?= $form->field($model, 'operator')->textInput(['maxlength' => true]) ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>

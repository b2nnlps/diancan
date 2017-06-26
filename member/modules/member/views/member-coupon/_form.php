<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberCoupon */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
    }
    .wrapper2 input {
        outline: none;
        cursor: pointer;
        border-radius: 5px;
        color: #FFF;
        border: 0;
        line-height: 75px;
        height: 75px;
        width: 75px;
        text-align: center;
        margin:5px;
    }
    .wrapper2 input[button]:hover {
        opacity: 0.9;
    }
    .wrapper2 {
        padding:10px;
        width:480px;
        max-width:480px;
        border: 1px #CCCCCC solid;
    }
    .yi {
        background: #61B357;
        box-shadow: 0 3px 1px #009933;
    }
    .er {
        background: #2B9F65;
        box-shadow: 0 3px 1px #006633;
    }
    .san {
        background: #4F9FC9;
        box-shadow: 0 3px 1px #0066CC;
    }
    .si {
        background: #5785CF;
        box-shadow: 0 3px 1px #0066CC;
    }
    .wu {
        background: #9161C1;
        box-shadow: 0 3px 1px #9933CC;
    }
    .liu {
        background: #D19B43;
        box-shadow: 0 3px 1px #BD6F17;
    }
    .qi {
        background: #E5B137;
        box-shadow: 0 3px 1px #D9A20F;
    }
    .ba {
        background: #EF913B;
        box-shadow: 0 3px 1px #D3591F;
    }
    .jiu {
        background: #DD6347;
        box-shadow: 0 3px 1px #CB5210;
    }
    .shi {
        background: #CD453B;
        box-shadow: 0 3px 1px #AC2811;
    }
</style>
<div class="member-coupon-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
    <?= $form->field($model, 'shop_id')->textInput() ?>

    <?= $form->field($model, 'brand_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'get_limit')->textInput() ?>

        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'img')->widget(\common\widgets\FileInput::className(),['dir'=>'upload/member','maxnum'=>1])->label('上传封面')?>

    <?= $form->field($model, 'background')->textInput(['maxlength' => true]) ?>

            <div class="col-sm-offset-2 col-sm-10">
                <div class="wrapper2">
                    <input type="button" class="yi"  onclick="background('#61B357')"/>
                    <input type="button" class="er" onclick="background('#2B9F65')"/>
                    <input type="button" class="san" onclick="background('#4F9FC9')"/>
                    <input type="button" class="si"  onclick="background('#5785CF')"/>
                    <input type="button" class="wu" onclick="background('#9161C1')"/>
                    <input type="button" class="liu" onclick="background('#D19B43')"/>
                    <input type="button" class="qi" onclick="background('#E5B137')"/>
                    <input type="button" class="ba" onclick="background('#EF913B')"/>
                    <input type="button" class="jiu" onclick="background('#DD6347')"/>
                    <input type="button" class="shi" onclick="background('#CD453B')"/>

                </div>
            </div>


    <?= $form->field($model, 'begin_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

        </div>
    </div>
    <?= $form->field($model, 'description')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function background(c){
        $("#membercoupon-background").val(c);
    }
</script>
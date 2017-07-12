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

    <?= $form->field($model, 'class_id')->dropDownList(ArrayHelper::map($model->getCategory(),'id','name')) ?>

    <?= $form->field($model, 'price')->textInput() ?>


    <?= $form->field($model, 'type')->textInput(['placeholder'=>'多种请用|隔开'])->label('规格（多个用|隔开）') ?>
    <button onclick="add();return false;">生成</button>
    <div id="guige">
        <?php
            foreach ($foodInfo as $_info){
                echo "<h4>$_info[title]</h4>价格<input type=\"text\" id=\"food-price\" name=\"guigePrice[$_info[id]]\" value=\"$_info[price]\"/>";
                echo "数量<input type=\"text\" id=\"food-price\" name=\"guigeNumber[$_info[id]]\" value=\"$_info[number]\"/><br>";
            }
        ?>
    </div>

    <?= $form->field($model, 'description')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function add(){
        var type=$("#food-type").val();
        var types=type.split("|"); //字符分割
        var i;
        $("#guige").html("<h4>请分别为规格输入价格、数量</h4>");
        for(i=0;i<types.length;i++){
            if(types[i].length!=0) {
                $("#guige").append('<h4>'+types[i] + '</h4>价格<input type="text" id="food-price" name="guigePrice[' + i + ']" value=""/> ');
                $("#guige").append('数量<input type="text" id="food-price" name="guigeNumber[' + i + ']" value=""/><br>');
                $("#guige").append('<p><input type="hidden" id="food-price" name="guigeTitle[' + i + ']" value="' + types[i] + '"/></p>');
            }
        }
        $("#guige").append('<p><input type="hidden" id="food-price" name="guigePrice[-1]" value="-1"/></p>');
return false;
    }
    </script>
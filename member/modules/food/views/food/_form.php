<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Food */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    #guige {
        margin: 10px 15px 15px 25px;
    }

    #guige li input {
        width: 90px;
        margin-right: 10px;
    }
</style>
<div class="food-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?php
            $role = Yii::$app->user->identity->role;
            if ($role < 3) {
                echo $form->field($model, 'shop_id')->dropDownList(\member\modules\food\models\Shop::getShopList(),
                [
                    'prompt' => '请选择商家',
                    'onchange' => '
                         $.post("lists?id=' . '"+$(this).val(),function(data){
                           $("select#food-class_id").html(data);
                     });',
                ]
                );
            }
            ?>

            <?= $form->field($model, 'class_id')->dropDownList(
                \member\modules\food\models\Classes::getClassesList(),
                [
                    'prompt' => '请选择菜品类别',
                ]
            ) ?>


            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <button style="margin: 5px 10px 5px;" onclick="add();return false;">添加规格</button>
            <div id="guige">
                <?php
                foreach ($foodInfo as $_info) {
                    $id = $_info['id'];
                    echo "<li>";
                    echo "规格：<input type=\"text\" id=\"guigeTitle$id\" name=\"guigeTitle[$id]\" value=\"$_info[title]\"/>";
                    echo "单位：<input type=\"text\" id=\"unitName$id\" name=\"unitName[$id]\" value=\"$_info[unit]\"/>";
                    echo "价格：<input type=\"text\" onblur=\"ischeckNum(this.value);\" id=\"guigePrice$id\" name=\"guigePrice[$id]\" value=\"$_info[price]\"/>";
                    echo "数量：<input type=\"number\" id=\"guigeNumber$id\" name=\"guigeNumber[$id]\" value=\"$_info[number]\"/><button onclick=\"del($id);return false;\">删除</button><br>";
                    echo "</li>";
                }
                ?>
            </div>

        </div>
        <div class="col-sm-6">

            <?= $form->field($model, 'head_img')->widget(\common\widgets\FileInput::className(), ['dir' => 'upload/food', 'maxnum' => 1])->label('首页图片') ?>

            <?= $form->field($model, 'img')->widget(\common\widgets\FileInput::className(), ['dir' => 'upload/food', 'maxnum' => 5])->label('菜品轮播图片') ?>


        </div>
    </div>

    <?= $form->field($model, 'description')->widget(\crazyfd\ueditor\Ueditor::className(),[]) ?>

    <?= $form->field($model, 'is_attach')->dropDownList($model::is_attach()) ?>

    <?= $form->field($model, 'status')->dropDownList($model::status()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    var len = 0;
    function add(){
        var text;
        text = ('<li>规格：<input type="text" id="guigeTitle' + len + '" name="guigeTitle[' + len + ']"  placeholder="没有可不填"/>');
        text += ('单位：<input type="text" id="unitName' + len + '" name="unitName[' + len + ']"  />');
        text += ('价格：<input type="text" onblur="ischeckNum(this.value);" id="guigePrice' + len + '" name="guigePrice[' + len + ']"/>');
        text += ('数量：<input type="number" id="guigeNumber' + len + '" name="guigeNumber[' + len + ']"/><button onclick=\"del(' + len + ');return false;\">删除</button><br></li>');
        $("#guige").append(text);
        len++;
//        $("#guige").append('<p><input type="hidden" id="food-price" name="guigePrice[-1]" value="-1"/></p>');
        return false;
    }
    function del(id) {
        $("#guigePrice" + id).val(-1).parent().hide();

    }

    //判断当前价格是否为数字
    //    function ischeckNum(num) {
    //        if (num) {
    //            if (isNaN(num)) {
    //                alert('你输入的数据不是数字');
    //                return false;
    //            }
    //        } else {
    //            alert('价格不能为空！');
    //            return false;
    //        }
    //    }
    </script>
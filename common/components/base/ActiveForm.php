<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components\base;

/**
 * Description of ActiveForm
 *
 * @author Administrator
 */
class ActiveForm extends \yii\bootstrap\ActiveForm
{
    //put your code here
    public $layout = 'horizontal';
    public $fieldConfig = [
        'options' => ['tag' => 'div','class' => 'form-group'],
        'template' => '{label}<div class="col-sm-6">{input}</div><div class="col-sm-4">{hint}{error}</div>',
        'labelOptions'=>['class'=>'col-sm-2 control-label'],
//        'labelOptions' => ['class' => 'col-lg-1 control-label'],
        //'inputOptions'=>['class'=>'form-control'],
    ];
}

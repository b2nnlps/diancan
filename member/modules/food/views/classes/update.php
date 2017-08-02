<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Classes */

$this->title = '修改菜类: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '菜类列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="classes-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

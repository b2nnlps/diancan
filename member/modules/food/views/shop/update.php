<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Shop */

$this->title = '修改店家: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '商家列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="shop-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Food */
/* @var $foodInfo member\modules\food\models\Food */

$this->title = '修改菜品: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="food-update">

    <?= $this->render('_form', [
        'model' => $model,
        'foodInfo'=>$foodInfo
    ]) ?>

</div>

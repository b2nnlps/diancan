<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Cart */

$this->title = '更新购物车: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '购物车列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="cart-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

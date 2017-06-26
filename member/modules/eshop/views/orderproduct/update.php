<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Orderproduct */

$this->title = '更新订单商品: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '订单商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="orderproduct-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

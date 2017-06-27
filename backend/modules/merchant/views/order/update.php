<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Order */

$this->title = '更新订单: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '订单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="order-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

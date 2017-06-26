<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Orderstatus */

$this->title = '更新订单状态: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '订单状态', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="orderstatus-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Stock */

$this->title = '更新库存信息: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '库存信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="stock-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

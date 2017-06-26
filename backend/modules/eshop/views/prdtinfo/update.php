<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Prdtinfo */

$this->title = '更新商品信息: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '商品信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="prdtinfo-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

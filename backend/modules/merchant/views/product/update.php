<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Product */

$this->title = '更新商品信息: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

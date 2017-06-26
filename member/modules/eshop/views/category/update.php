<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Category */

$this->title = '更新商品分类: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '更新商品分类列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

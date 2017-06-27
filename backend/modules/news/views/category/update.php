<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsCategory */

$this->title = '更新资讯分类: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '分类列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="news-category-update">

    <?= $this->render('_form', [
        'model' => $model,
        'list' => $list
    ]) ?>

</div>

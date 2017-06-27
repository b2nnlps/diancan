<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsInfo */

$this->title = '更新资讯信息: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '资讯列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="news-info-update">

    <?= $this->render('_form', [
        'model' => $model,
        'list' => $list
    ]) ?>

</div>

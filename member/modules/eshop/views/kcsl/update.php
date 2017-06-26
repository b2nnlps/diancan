<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Kcsl */

$this->title = '更新库房记录: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '库房记录', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="kcsl-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

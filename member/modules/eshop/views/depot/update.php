<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Depot */

$this->title = '更新库房信息: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '库房列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="depot-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

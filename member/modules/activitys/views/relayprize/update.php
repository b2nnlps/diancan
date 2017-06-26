<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\activitys\models\Relayprize */

$this->title = '更新奖品信息: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '奖品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="relayprize-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

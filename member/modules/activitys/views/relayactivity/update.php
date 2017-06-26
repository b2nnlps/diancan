<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\activitys\models\RelayActivity */

$this->title = '更新 活动: ' . $model->merchant;
$this->params['breadcrumbs'][] = ['label' => '活动列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->merchant, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="relay-activity-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

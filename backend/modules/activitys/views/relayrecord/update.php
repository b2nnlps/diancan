<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\RelayRecord */

$this->title = 'Update Relay Record: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Relay Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relay-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

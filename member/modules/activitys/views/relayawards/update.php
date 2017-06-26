<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\activitys\models\RelayAwards */

$this->title = '更新获奖信息: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '获奖列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relay-awards-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

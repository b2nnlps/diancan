<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\RelayApplicant */

$this->title = '更新 报名人信息: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '报名人列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="relay-applicant-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

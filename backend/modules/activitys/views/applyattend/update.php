<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\ApplyAttend */

$this->title = '更新报名者信息: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '报名列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="apply-attend-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

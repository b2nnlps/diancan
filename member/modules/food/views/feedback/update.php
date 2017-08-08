<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Feedback */

$this->title = '更新反馈: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '反馈列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="feedback-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

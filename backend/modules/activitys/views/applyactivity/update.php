<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\ApplyActivity */
$title=\common\models\ComModel::cut_str($model->title,21);
$this->title = '更新活动: ' . $title;
$this->params['breadcrumbs'][] = ['label' => '活动列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="apply-activity-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

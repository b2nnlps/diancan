<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\Loginlog */

$this->title = '更新登录日志: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '登录日志列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="loginlog-update">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\Link */

$this->title = '更新 Link: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Links 列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="link-update">
    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

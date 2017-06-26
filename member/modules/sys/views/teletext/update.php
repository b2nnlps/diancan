<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Teletext */

$this->title = '更新图文: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '图文列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="teletext-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

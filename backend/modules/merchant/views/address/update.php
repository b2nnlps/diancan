<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Address */

$this->title = '更新地址: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '地址列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="address-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Supplier */

$this->title = '更新商家信息: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '商家信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="supplier-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

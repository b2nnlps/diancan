<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\ShopStaff */

$this->title = '修改员工: ' . $model->realname;
$this->params['breadcrumbs'][] = ['label' => '员工列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="shop-staff-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

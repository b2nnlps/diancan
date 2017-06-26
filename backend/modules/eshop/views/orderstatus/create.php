<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Orderstatus */

$this->title = '新增订单状态';
$this->params['breadcrumbs'][] = ['label' => '订单状态', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderstatus-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

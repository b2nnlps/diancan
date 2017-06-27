<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Orderproduct */

$this->title = '新增订单商品';
$this->params['breadcrumbs'][] = ['label' => '订单商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderproduct-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

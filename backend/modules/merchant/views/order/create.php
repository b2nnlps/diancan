<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Order */

$this->title = '新增订单';
$this->params['breadcrumbs'][] = ['label' => '订单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

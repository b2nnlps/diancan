<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Product */

$this->title = '新增商品信息';
$this->params['breadcrumbs'][] = ['label' => '商品信息列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

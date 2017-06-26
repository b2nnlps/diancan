<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Prdtinfo */

$this->title = '新增商品信息';
$this->params['breadcrumbs'][] = ['label' => '商品信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prdtinfo-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

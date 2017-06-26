<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Sumpplier */

$this->title = '新增商家信息';
$this->params['breadcrumbs'][] = ['label' => '商家信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sumpplier-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Shop */

$this->title = '添加商家信息';
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

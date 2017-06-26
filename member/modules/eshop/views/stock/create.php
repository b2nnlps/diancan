<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Stock */

$this->title = '新增库存信息';
$this->params['breadcrumbs'][] = ['label' => '库存信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

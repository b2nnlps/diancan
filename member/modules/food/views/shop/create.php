<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Shop */

$this->title = '新店';
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

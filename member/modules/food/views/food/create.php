<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Food */

$this->title = '添加菜品';
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-create">

    <?= $this->render('_form', [
        'model' => $model,
        'foodInfo'=>$foodInfo
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Category */

$this->title = '新增商品分类';
$this->params['breadcrumbs'][] = ['label' => '商品分类列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

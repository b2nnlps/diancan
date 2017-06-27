<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Cart */

$this->title = '添加购物车';
$this->params['breadcrumbs'][] = ['label' => '购物车列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

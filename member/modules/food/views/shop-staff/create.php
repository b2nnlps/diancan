<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\food\models\ShopStaff */

$this->title = '添加员工';
$this->params['breadcrumbs'][] = ['label' => '员工列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-staff-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

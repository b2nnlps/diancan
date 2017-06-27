<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Supplier */

$this->title = '新增商家信息';
$this->params['breadcrumbs'][] = ['label' => '商家信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

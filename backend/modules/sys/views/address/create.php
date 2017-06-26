<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\Address */

$this->title = '新增地址';
$this->params['breadcrumbs'][] = ['label' => '地址列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Agent */

$this->title = '新增代理商品';
$this->params['breadcrumbs'][] = ['label' => '代理商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

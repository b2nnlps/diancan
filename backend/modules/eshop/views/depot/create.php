<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Depot */

$this->title = '新增库房信息';
$this->params['breadcrumbs'][] = ['label' => '库房列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="depot-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

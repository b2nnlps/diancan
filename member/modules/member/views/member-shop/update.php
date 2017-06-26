<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberShop */

$this->title = 'Update Member Shop: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Member Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-shop-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

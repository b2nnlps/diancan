<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberShopStaff */

$this->title = 'Update Member Shop Staff: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Member Shop Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-shop-staff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

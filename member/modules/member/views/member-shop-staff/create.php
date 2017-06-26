<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberShopStaff */

$this->title = 'Create Member Shop Staff';
$this->params['breadcrumbs'][] = ['label' => 'Member Shop Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-shop-staff-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

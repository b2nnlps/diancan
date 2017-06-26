<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberShop */

$this->title = 'Create Member Shop';
$this->params['breadcrumbs'][] = ['label' => 'Member Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-shop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

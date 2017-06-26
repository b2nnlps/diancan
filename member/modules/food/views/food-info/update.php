<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\FoodInfo */

$this->title = 'Update Food Info: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Food Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="food-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

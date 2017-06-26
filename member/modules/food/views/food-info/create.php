<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\food\models\FoodInfo */

$this->title = 'Create Food Info';
$this->params['breadcrumbs'][] = ['label' => 'Food Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

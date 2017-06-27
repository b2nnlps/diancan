<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\ApplyAttend */

$this->title = 'Create Apply Attend';
$this->params['breadcrumbs'][] = ['label' => 'Apply Attends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apply-attend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

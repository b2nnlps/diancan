<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\activitys\models\RelayRecord */

$this->title = 'Create Relay Record';
$this->params['breadcrumbs'][] = ['label' => 'Relay Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relay-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

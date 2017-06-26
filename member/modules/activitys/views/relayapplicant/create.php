<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\activitys\models\RelayApplicant */

$this->title = 'Create Relay Applicant';
$this->params['breadcrumbs'][] = ['label' => 'Relay Applicants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relay-applicant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

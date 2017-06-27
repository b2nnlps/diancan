<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\ApplyAudit */

$this->title = 'Create Apply Audit';
$this->params['breadcrumbs'][] = ['label' => 'Apply Audits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apply-audit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

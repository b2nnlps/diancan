<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberRecord */

$this->title = 'Create Member Record';
$this->params['breadcrumbs'][] = ['label' => 'Member Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

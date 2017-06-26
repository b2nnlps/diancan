<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberBind */

$this->title = 'Update Member Bind: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Member Binds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-bind-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

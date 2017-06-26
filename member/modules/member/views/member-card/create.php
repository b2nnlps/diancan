<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberCard */

$this->title = 'Create Member Card';
$this->params['breadcrumbs'][] = ['label' => 'Member Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-card-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

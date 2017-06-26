<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberBind */

$this->title = 'Create Member Bind';
$this->params['breadcrumbs'][] = ['label' => 'Member Binds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-bind-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

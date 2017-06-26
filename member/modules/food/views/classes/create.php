<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Classes */

$this->title = '新建新菜类';
$this->params['breadcrumbs'][] = ['label' => 'Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Classes */

$this->title = '新建新菜类';
$this->params['breadcrumbs'][] = ['label' => '菜类列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

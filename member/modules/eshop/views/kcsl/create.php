<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Kcsl */

$this->title = '新增库房记录';
$this->params['breadcrumbs'][] = ['label' => '库房记录', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kcsl-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

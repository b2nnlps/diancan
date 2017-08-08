<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Feedback */

$this->title = '添加反馈';
$this->params['breadcrumbs'][] = ['label' => '反馈列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

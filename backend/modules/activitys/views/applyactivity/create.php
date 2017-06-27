<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\ApplyActivity */

$this->title = '发布活动';
$this->params['breadcrumbs'][] = ['label' => '活动列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apply-activity-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

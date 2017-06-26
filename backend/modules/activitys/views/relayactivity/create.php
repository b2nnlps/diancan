<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\RelayActivity */

$this->title = '创建 活动';
$this->params['breadcrumbs'][] = ['label' => '活动列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relay-activity-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

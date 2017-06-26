<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\activitys\models\RelayAwards */

$this->title ='新增获奖信息';
$this->params['breadcrumbs'][] = ['label' => '获奖列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relay-awards-create">
    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

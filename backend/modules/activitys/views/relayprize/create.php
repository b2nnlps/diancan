<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\Relayprize */

$this->title = '新增奖品信息';
$this->params['breadcrumbs'][] = ['label' => '奖品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relayprize-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

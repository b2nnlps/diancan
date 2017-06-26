<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\Verification */

$this->title = '更新验证码: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '验证码列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="verification-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

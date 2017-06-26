<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\user */

$this->title = '更新用户: ' . $model->realname;
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->realname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Wechat */

$this->title = '更新微信用户信息: ' . $model->nickname;
$this->params['breadcrumbs'][] = ['label' => '微信用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nickname, 'url' => ['view', 'id' => $model->openid]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="wechat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

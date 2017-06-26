<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Loginlog */

$this->title = '新增登录日志';
$this->params['breadcrumbs'][] = ['label' => '登录日志列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loginlog-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

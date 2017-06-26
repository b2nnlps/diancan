<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Verification */

$this->title = '新增验证码';
$this->params['breadcrumbs'][] = ['label' => '验证码列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verification-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

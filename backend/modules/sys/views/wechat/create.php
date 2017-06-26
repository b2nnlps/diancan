<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\Wechat */

$this->title = '新增微信用户';
$this->params['breadcrumbs'][] = ['label' => '微信用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechat-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

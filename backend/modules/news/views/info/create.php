<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsInfo */

$this->title = '创建资讯信息';
$this->params['breadcrumbs'][] = ['label' => '资讯列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-info-create">

    <?= $this->render('_form', [
        'model' => $model,
        'list' => $list
    ]) ?>

</div>

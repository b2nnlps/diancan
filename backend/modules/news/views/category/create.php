<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsCategory */

$this->title = '创建分类';
$this->params['breadcrumbs'][] = ['label' => '资讯分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-create">
    
    <?= $this->render('_form', [
        'model' => $model,
        'list' => $list
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '分类列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'=>'商家名称',
                'value'=>  \backend\modules\eshop\models\Sumpplier::getName($model->supplier_id),
            ],
            'name',
            [
                'label'=>  '父分类',
                'value' =>$model::getCategoryName($model->pid),
            ],
            'path',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            [
                'label'=>'更新人',
                'value'=> \common\models\User::getUser($model->uid),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

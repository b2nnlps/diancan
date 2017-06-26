<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Teletext */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '图文列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teletext-view">

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
            'title',
            [
                'attribute' => 'category_id',
                'value' => $model->category($model->category_id),
            ],
            'description',
            'picurl:url',
            [
                'attribute' => 'whether',
                'value' => $model->whether($model->whether),
            ],
            'url:url',
            [
                'attribute' => 'hret',
                'value' => $model->status($model->hret),
            ],
            'hret',
            'content',
            [
                'attribute' => 'status',
                'value' => $model->status($model->status),
            ],
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model member\modules\activitys\models\RelayAwards */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '获奖列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relay-awards-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'isn',
            'prize_id',
            'prize_name',
            'sponsor_name',
            'prize_winner',
            'name',
            'phone',
			'point',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            'win_time',
            'get_time',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\Relayprize */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '奖品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relayprize-view">
    

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
            'name',
            [
                'attribute'=>'img',
                'value'=>$model->img,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'web_url:url',
            'number',
            'surplus',
			'point',
            'sponsor',
            'contacts',
            'phone',
            'address',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            [
                'attribute' => 'created_by',
                'value'=> User::getUser($model->created_by),
            ],
            [
                'attribute' => 'updated_by',
                'value'=> User::getUser($model->updated_by),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

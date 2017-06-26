<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\RelayActivity */

$this->title = $model->merchant;
$this->params['breadcrumbs'][] = ['label' => '活动列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relay-activity-view">

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
            'title',
            [
                'attribute' => 'type',
                'value' =>$model::type($model->type),
            ],
//            'imgurl:ntext',
            [
                'attribute'=>'imgurl',
                'value'=>$model->imgurl,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'start_time',
            'end_time',
            'merchant',
            'willnum',
            'visit',
            'send_title',
            'send_detail',
//            'content:html',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            [
                'label'=>'操作人',
                'value'=> \common\models\User::getUser($model->u_id),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

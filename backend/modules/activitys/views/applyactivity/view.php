<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\ApplyActivity */
$title=\common\models\ComModel::cut_str($model->title,21);
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '活动列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apply-activity-view">


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
            'imgurl:html',
            'start_time',
            'end_time',
            'address',
            'mapmove',
            [
                'attribute' => 'type',
                'value' =>$model::type($model->type),
            ],
            'supplier_id',
            'merchant',
            'initiator',
            'phone',
            'message',
            'uid', 
            'hedimg',
            'url', 
            'intro',
            'charge',
            'restrict',
            'willnum',
            'pv',
            'send_title',
//            'send_detail',
//            'content:ntext',
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

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\RelayApplicant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '报名人员列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="relay-applicant-view">

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
            [
                'label'=>'微信昵称',
                'attribute' => 'wechat_id',
                'value' =>\backend\modules\sys\models\WechatUser::getNickname($model->wechat_id),
            ],
            [
                'label'=>'活动名称',
                'attribute' => 'activity_id',
                'value' =>\backend\modules\activitys\models\RelayActivity::getTitle($model->activity_id),
            ],
            'name',
            'mobilephone',
            'point',
            'datetime',
            'declaration',
            'imgurl:ntext',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
        ],
    ]) ?>

</div>


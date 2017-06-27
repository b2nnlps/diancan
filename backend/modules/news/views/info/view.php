<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\news\models\NewsCategory;
/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsInfo */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '资讯列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-info-view">

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
            [
                'label'=>  '所属',
                'value' =>\backend\modules\news\models\NewsCategory::getCategoryName($model->cid),
            ],
            'title',
            'intro',
            'img',
            [
                'attribute' => 'carousel',
                'value' =>$model::carousel($model->carousel),
            ],
            'source',
            'source_url:url',
            'editor',
            [
                'attribute' => 'hret_status',
                'value' =>$model::hretstatus($model->hret_status),
            ],
            'hret_url:url',
//            'content:ntext',
            'pv',
            'praise',
            'collect',
            'transpond',
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

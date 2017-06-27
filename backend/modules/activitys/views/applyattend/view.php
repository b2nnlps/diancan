<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\activitys\models\ApplyAttend */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '报名列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apply-attend-view">

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
            'uid',
            'sid',
             [
                'label'=>'活动名称',
                'attribute' => 'aid',
                'value' =>\backend\modules\activitys\models\ApplyActivity::getTitle($model->aid),
            ],
			'item',
            'name',
            'phone',
		    'number',
		    'cost',
            'explain',
            'remark',
            [
                'attribute' => 'ispay',
                'value' =>$model::ispay($model->ispay),
            ],
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

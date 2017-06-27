<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Supplier */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商家列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-view">

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
            'rh_openid',
            'name',
            [
                'attribute' => 'rank',
                'value' =>$model::rank($model->rank),
            ],
            'website',
            'ad_img',
            'pv',
            'labels',
            'logo',
            'phone',
            'address',
            'map',
            'open_hours',
            'open_scope',
            'notice',
            'message:ntext',
            'brief',
//            'content:ntext',
            [
                'attribute' => 'open',
                'value' =>$model::open($model->open),
            ],
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            [
                'label'=>'创建人',
                'value'=> User::getUser($model->created_by),
            ],
            [
                'label'=>'更新人',
                'value'=>User::getUser($model->updated_by),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

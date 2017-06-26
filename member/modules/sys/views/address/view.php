<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use member\modules\sys\models\Member;
/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Address */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '地址列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-view">

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
            'user_id',
            [
                'label'=>'用户',
                'attribute' => 'user_id',
                'value' =>Member::getMemberName($model->user_id),
            ],
            'consignee',
            'phone',
//            'provinvce',
//            'city',
//            'district',
            'address',
            'zipcode',
//            'default',
            [
                'attribute' => 'default',
                'value' =>$model::defaults($model->default),
            ],
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            [
                'label'=>'更新人',
                'value'=>  \common\models\User::getUser($model->updated_by),
            ],
            
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Address */

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
            'rh_openid',
            [
                'label'=>'所属用户',
                'attribute' => 'rh_openid',
                'value' =>\backend\modules\merchant\models\Member::getMemberName($model->rh_openid),
            ],
            'consignee',
            'phone',
            'provinvce',
            'city',
            'district',
            'address',
            'zipcode',
            [
                'attribute' => 'default',
                'value' =>$model::defaults($model->default),
            ],
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            [
                'attribute' => 'operator',
                'value' =>\backend\modules\merchant\models\Member::getMemberName($model->operator),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

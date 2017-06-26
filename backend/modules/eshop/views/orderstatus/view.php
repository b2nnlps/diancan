<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model backend\modules\eshop\models\Orderstatus */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '订单状态', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderstatus-view">

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
            'user_id',
            [
                'label'=>'用户',
                'attribute' => 'user_id',
                'value' =>\backend\modules\sys\models\Member::getMemberName($model->user_id),
            ],
            [
                'label'=>'微信昵称',
                'attribute' => 'user_id',
                'value' => \backend\modules\sys\models\WechatUser::getNickname($model->user_id),
            ],
            'order_id',
            'product_id',
            [
                'label'=>'商品名称',
                'attribute' => 'product_id',
                'value' => \backend\modules\eshop\models\Product::getProductName($model->product_id),
            ],
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            'remark',
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

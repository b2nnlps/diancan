<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\merchant\models\Member;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '订单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'id',
//            'order_id',
            [
                'label'=>'订单商品名称',
                'attribute'=>'name',
            ],
            'number',
            'sku',
            'price',
            'amount',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'remark',
            [
                'label'=>'下单时间',
                'attribute'=>'time',
            ],

            [
                'class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '100'],
                'buttons'=>[
                    'view' =>function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['orderproduct/view','id'=>$model->id,],
                            ['title' =>'订购商品详情']);
                        return '';
                    },
                    'update' =>function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            ['orderproduct/update','id'=>$model->id,],
                            ['title' =>'更新订购商品']);
                        return '';
                    },
                    'delete' =>function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['orderproduct/delete','id'=>$model->id,],
                            ['title' =>'删除订购商品']);
                        return '';
                    },
                ],
                'template' => '{view}{update}&nbsp;{delete}'
            ],
        ],
    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'id',
//            'order_id',
//            'product_id',
            [
                'label'=>'订单状态',
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            [
                'label'=>'操作员',
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return Member::getMemberName($model->rh_openid);
                },

            ],
            [
                'label'=>'备注',
                'attribute' => 'remark',
            ],
            'time',
            [
                'class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '100'],
                'buttons'=>[
                    'view' =>function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['orderstatus/view','id'=>$model->id,],
                            ['title' =>'订单状态详情']);
                        return '';
                    },
                    'update' =>function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            ['orderstatus/update','id'=>$model->id,],
                            ['title' =>'订单更新状态']);
                        return '';
                    },
                    'delete' =>function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                            ['orderstatus/delete','id'=>$model->id,],
                            ['title' =>'删除订单状态']);
                        return '';
                    },
                ],
                'template' => '{view}{update}&nbsp;{delete}'
            ],
        ],
    ]); ?>
</div>

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
<div class="order-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sn',
            'rh_openid',
            [
               'label'=>'下单人',
                'attribute' => 'rh_openid',
                'value' =>Member::getMemberName($model->rh_openid),
            ],
            'supplier_id',
//            [
//                'label'=>'推荐人ID',
//                'attribute' => 'referrer',
//            ],
//            [
//                'label'=>'推荐人',
//                'attribute' => 'referrer',
//                'value' =>Member::getMemberName($model->referrer),
//            ],
            'consignee',
            'phone',
            'amount',
//            'province',
//            'city',
//            'district',
            'address',
            'zipcode',
            'receive_time',
            'remark',
            [
                'attribute' => 'payment_method',
                'value' =>$model::method($model->payment_method),
            ],
            [
                'attribute' => 'payment_status',
                'value' =>$model::payment_status($model->payment_status),
            ],
            [
                'label'=>'配送方',
                'value'=> $model::shipment_id($model->shipment_id),
            ],
            [
                'label'=>'配送状态',
                'value'=> $model::shipment_status($model->shipment_status),
            ],
//            [
//                'attribute' => 'status',
//                'value' =>$model::status($model->status),
//            ],
//            [
//                'label'=>'是否结算',
//                'value'=> $model::clearing($model->clearing),
//            ],

//            'receiv_status',
//            'shipment_status',
            [
                'attribute' => 'operator',
                'value' =>\backend\modules\merchant\models\Member::getMemberName($model->operator),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

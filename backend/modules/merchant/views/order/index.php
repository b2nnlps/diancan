<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\merchant\models\Member;
use backend\modules\merchant\models\Supplier;
use backend\modules\merchant\models\Order;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\merchant\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sn',
            [
                'label'=>'下单人',
                'attribute' => 'rh_openid',
                'value' => function ($model) {
                    return Member::getMemberName($model->rh_openid);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'rh_openid',
                    Member::getrealname($searchModel->rh_openid),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],

            [
                'label'=>'代理商',
                'attribute' => 'supplier_id',
                'value' => function ($model) {
                    return Supplier::getName($model->supplier_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'supplier_id',
                    Supplier::getSupplier($searchModel->supplier_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
//            [
//                'label'=>'推介人',
//                'attribute' => 'referrer',
//                'value' => function ($model) {
//                    return Member::getMemberName($model->referrer);
//                },
//                'filter' => Html::activeDropDownList(
//                    $searchModel,
//                    'referrer',
//                    Member::getrealname($searchModel->referrer),
//                    ['class' => 'form-control', 'prompt' =>'请筛选']
//                )
//            ],
             'consignee',
            [
                'attribute' => 'phone',
                'value' => function ($model) {
                    return \common\models\ComModel::hidtel($model->phone);
                },
            ],
             'amount',
            // 'province',
            // 'city',
            // 'district',
            [
                'attribute' => 'address',
                'value' => function ($model) {
                    return \common\models\ComModel::cut_str($model->address,20 );
                },
            ],
//            'zipcode',
            // 'receive_time',
            // 'remark',
            [
                'attribute' => 'payment_method',
                'filter' =>Order::method(),
                'value' => function ($model) {
                    return $model->method($model->payment_method);
                },
            ],
            [
                'attribute' => 'payment_status',

                'filter' =>Order::payment_status(),
                'value' => function ($model) {
                    return $model->payment_status($model->payment_status);
                },
            ],
            // 'receiv_status',

            [
                'attribute' => 'shipment_status',

                'filter' =>Order::shipment_status(),
                'value' => function ($model) {
                    return $model->shipment_status($model->shipment_status);
                },
            ],
            // 'shipment_id',
            // 'clearing',
//            [
//                'attribute' => 'status',
////                "headerOptions" => ["width" => "80"],
//                'filter' =>Order::status(),
//                'value' => function ($model) {
//                    return $model->status($model->status);
//                },
//            ],
            // 'operator',
            [
                'label'=>'下单时间',
                'attribute'=>'created_time',
            ],
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\sys\models\Member;
use backend\modules\eshop\models\Order;
use backend\modules\sys\models\WechatUser;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\eshop\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a('新增订单', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sn',
			  [
                'label'=>'推介人',
                'attribute' => 'referrer',
                'value' => function ($model) {
                    return Member::getMemberName($model->referrer);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'referrer',
                    Member::getrealname($searchModel->referrer),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
            [
                'label'=>'用户名',
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return Member::getMemberName($model->user_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'user_id',
                    Member::getrealname($searchModel->user_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
          
            'consignee',
            [
                'attribute' => 'phone',
                'value' => function ($model) {
                    return \common\models\ComModel::hidtel($model->phone);
                },
            ],
             'amount',
            // 'zipcode',
            // 'province',
            // 'city',
            // 'district',
            // 'address',
            // 'remark',
            [
                'attribute' => 'payment_method',
				 "headerOptions" => ["width" => "180"],	
                'filter' =>Order::method(),
                'value' => function ($model) {
                    return $model->method($model->payment_method);
                },
            ],
            // 'payment_status',
            [
                'attribute' => 'payment_status',
				 "headerOptions" => ["width" => "180"],
                'filter' =>Order::payment_status(),
                'value' => function ($model) {
                    return $model->payment_status($model->payment_status);
                },
            ],
            // 'shipment_id',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>Order::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            [
                'attribute' => 'clearing',
				 "headerOptions" => ["width" => "180"],
                'filter' =>Order::clearing(),
                'value' => function ($model) {
                    return $model->clearing($model->clearing);
                },
            ],
            // 'updated_by',
            [
                'label'=>'下单时间',
                'attribute'=>'created_time',
            ],
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

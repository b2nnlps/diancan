<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\sys\models\Member;
use backend\modules\sys\models\WechatUser;
use backend\modules\eshop\models\Product;
use backend\modules\eshop\models\Sumpplier;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\eshop\models\search\OrderproductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单商品';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'微信昵称',
                'attribute' => 'openid',
                "headerOptions" => ["width" => "160"],
                'value' => function ($model) {
                    return WechatUser::getNickname($model->user_id);
                },
            ],
            'id',
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
          
			[
                'label'=>'订单ID',
                'attribute' => 'order_id',
                'value' => function ($model) {
                    return Html::a($model->order_id, "/eshop/order/view?id={$model->order_id}", ['target' => '_blank']);
                },
				'format' => 'raw',
            ],
            [
                'label'=>'商家',
                'attribute' => 'supplier_id',
                'value' => function ($model) {
                    return Sumpplier::getName($model->supplier_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'supplier_id',
                    Sumpplier::getSumpplier($searchModel->supplier_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
            [
                'label'=>'商品名称',
                'attribute' => 'product_id',
                'value' => function ($model) {
                    return Product::getProductName($model->product_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'product_id',
                    Product::getProduct($searchModel->product_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
            'sku',
            // 'name',
             'number',
             'price',
            // 'amount',
//            [
//                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
//                'filter' =>\backend\modules\eshop\models\Orderproduct::status(),
//                'value' => function ($model) {
//                    return $model->status($model->status);
//                },
//            ],
            // 'remark',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

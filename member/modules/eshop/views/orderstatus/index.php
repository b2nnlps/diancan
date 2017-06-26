<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\sys\models\Member;
use member\modules\sys\models\WechatUser;
use member\modules\eshop\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\eshop\models\search\OrderstatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单状态';
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
                'label'=>'操作员',
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
            'order_id',
//            'product_id',
//            [
//                'label'=>'商品名称',
//                'attribute' => 'product_id',
//                'value' => function ($model) {
//                    return Product::getProductName($model->product_id);
//                },
//                'filter' => Html::activeDropDownList(
//                    $searchModel,
//                    'product_id',
//                    Product::getProduct($searchModel->product_id),
//                    ['class' => 'form-control', 'prompt' =>'请筛选']
//                )
//            ],
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>\member\modules\eshop\models\Orderstatus::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'remark',
            // 'created_by',
            // 'updated_by',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

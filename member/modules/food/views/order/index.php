<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\food\models\Shop;
/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ["width" => "20"],
            ],
       //     'num',
           // 'user',
            [
                'label' => '商家名称',
                'attribute' => 'shop_id',
                'value' => function ($model) {
                    return Shop::getShopName($model->shop_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'shop_id',
                    Shop::getShopList($searchModel->shop_id),
                    ['class' => 'form-control', 'prompt' => '请筛选']
                )

            ],
            'realname',
            'phone',

            'table',
            'people',
            'total',
//             'type',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' => \member\modules\food\models\Order::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            'created_time',
//             'updated_time',
//            'text:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

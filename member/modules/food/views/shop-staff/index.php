<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\food\models\ShopStaff;
use member\modules\food\models\Shop;
/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\ShopStaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '员工管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-staff-index">

    <p>
        <?= Html::a('添加员工', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'realname',
            'phone',
       //     'openid',
            'username',
       //    'password',

            [
                'label' => '所属商家',
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
            [
                'attribute' => 'role_id',
//                "headerOptions" => ["width" => "80"],
                'filter' => ShopStaff::role(),
                'value' => function ($model) {
                    return $model->role($model->role_id);
                },
            ],
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' => ShopStaff::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            'created_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

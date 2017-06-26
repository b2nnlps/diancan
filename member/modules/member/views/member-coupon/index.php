<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\member\models\search\MemberCouponSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Coupons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-coupon-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Member Coupon', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shop_id',
            'brand_name',
            'title',
            'sub_title',
            // 'description:ntext',
            // 'img',
            // 'background',
            // 'quantity',
            // 'cost',
            // 'status',
            // 'get_limit',
            // 'begin_time',
            // 'end_time',
            // 'created_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

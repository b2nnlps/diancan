<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\food\models\Shop;
/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '反馈列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
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
            'user',
//            'text:ntext',
            'created_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

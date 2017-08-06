<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\food\models\Shop;
/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\ClassesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜类列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-index">


    <p>
        <?= Html::a('新菜类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    \richardfan\sortable\SortableGridView::widget([
        'dataProvider' => $dataProvider,

        // SortableGridView Configurations
        'sortUrl' => \yii\helpers\Url::to(['sortItem']),
        'sortingPromptText' => 'Loading...',
        'failText' => 'Fail to sort',

        'columns' => [
            // Data Columns
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                "headerOptions" => ["width" => "80"],

            ],
            'name',
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
            'sort',
            'updated_time',
            // 'created_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

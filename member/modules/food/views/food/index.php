<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\food\models\Classes;
use member\modules\food\models\Shop;
/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\FoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜品列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-index">


    <p>
        <?= Html::a('新❤菜品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= \richardfan\sortable\SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // SortableGridView Configurations
        'sortUrl' => \yii\helpers\Url::to(['sortItem']),
        'sortingPromptText' => 'Loading...',
        'failText' => 'Fail to sort',

        'columns' => [
            // Data Columns
            [
                'headerOptions' => ["width" => "80"],
                'label' => '图像',
                'format'=>'raw',
                'value' => function ($model) {
                    if ($model->head_img) {
                        return "<img src='$model->head_img' width='40px'/>";
                    } else {
                        return '';
                    }
                },
            ],
            [
                'attribute' => 'id',
                'headerOptions' => ["width" => "20"],
            ],
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
            'name',
//            'price',
            [
                'label' => '所属分类',
                'attribute' => 'class_id',
                'value' => function ($model) {
                    return Classes::getClassesName($model->class_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'class_id',
                    Classes::getClassesList($searchModel->class_id),
                    ['class' => 'form-control', 'prompt' => '请筛选']
                )
            ],
            'sold_number',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' => \member\modules\food\models\Food::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            'sort',
            'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>
</div>

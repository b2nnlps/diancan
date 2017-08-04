<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\ShopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商家列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        $userId = Yii::$app->user->id;//获取当前登录用户的ID
        $user = \member\modules\sys\models\User::findOne($userId);
        $shop_id = $user->shop_id;
        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID
        if ($role < 3 || $shop_id == '') {//如果权限为系统管理员或该商家用户表没绑定

            echo Html::a('添加商家信息', ['create'], ['class' => 'btn btn-success']);
        }

        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'headerOptions' => ["width" => "80"],
                'format' => ['image', ['width' => '35', 'height' => '30']],
                'value' => function ($model) {
                    return $model->img;
                },
                'label' => '头像',
            ],
            'id',
            'name',
            'contact',
            'address',

            // 'menu',
            'created_time',

            ['class' => 'yii\grid\ActionColumn'],

//            [
//                'class' => 'yii\grid\ActionColumn',
//                'contentOptions'=>['style'=>'text-align:center; width:100px;'],
//                'buttons'=>[
//                    'view' =>function ($url, $model, $key) {
//                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
//                            'title' =>'查看',
//                        ]);
//                    },
//                    'food' =>function ($url, $model, $key) {
//                        return Html::a('<span class="glyphicon glyphicon-cutlery"></span>', '/food/food/index?shop_id='.$model->id, [
//                            'title' =>'菜品',
//                        ]);
//                    },
//
//
//
//                ],
//                'template' => '{view}{food}'
//            ],
        ],
    ]); ?>
</div>

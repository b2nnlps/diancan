<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\ShopStaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '员工管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-staff-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加员工', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            'phone',
       //     'openid',
            'username',
       //    'password',
             'realname',
             'shop_id',
             'role_id',
            // 'status',
            // 'created_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

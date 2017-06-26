<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\member\models\search\MemberShopStaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Shop Staff';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-shop-staff-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Member Shop Staff', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'openid',
            'shop_id',
            'created_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

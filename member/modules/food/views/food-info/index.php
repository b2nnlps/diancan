<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\FoodInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Food Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Food Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'price',
            'food_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

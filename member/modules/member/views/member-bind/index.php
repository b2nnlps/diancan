<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\member\models\search\MemberBindSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Binds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-bind-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Member Bind', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'openid',
            'card_id',
            'type',
            'phone',
            // 'realname',
            // 'begin_time',
            // 'end_time',
            // 'created_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

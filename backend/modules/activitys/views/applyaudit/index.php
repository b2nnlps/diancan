<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\activitys\models\search\ApplyauditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apply Audits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apply-audit-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Apply Audit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'uid',
            'item',
            'sid',
            'aid',
            // 'name',
            // 'phone',
            // 'wx_number',
            // 'remark',
            // 'status',
            // 'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

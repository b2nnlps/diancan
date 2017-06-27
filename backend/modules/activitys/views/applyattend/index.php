<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\activitys\models\ApplyActivity;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\activitys\models\search\ApplyattendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '报名列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a('新建报名信息', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
         //   ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'uid',
//            'sid',
            [
                'label'=>'活动名称',
                'attribute' => 'aid',
				"headerOptions" => ["width" => "150"],
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'aid',
                ApplyActivity::getArrayitle($searchModel->aid),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                ),
                'value' => function ($model) {
                     return \common\models\ComModel::cut_str(ApplyActivity::getTitle($model->aid),30);
                },
            ],
//			 'item',
             'name',
             'phone',
           //  'remark',
          //   'ispay',
            'number',
			 'cost',
            // 'explain',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>\backend\modules\activitys\models\ApplyAttend::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

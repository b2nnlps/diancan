<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sys\models\search\VerificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '验证码列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verification-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
//            [
//                'label'=>'用户',
//                'attribute' => 'c_uid',
//                'value' => function ($model) {
//                    return \common\models\User::getUser($model->c_uid);
//                },
//                'filter' => Html::activeDropDownList(
//                    $searchModel,
//                    'c_uid',
//                    \common\models\User::getName($searchModel->c_uid),
//                    ['class' => 'form-control', 'prompt' =>'请筛选']
//                )
//            ],
            'code',
            'phone',
            'time',
             'click',
             'totalclick',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' => \backend\modules\sys\models\Verification::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'remarks',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\sys\models\WechatUser;
use member\modules\activitys\models\RelayActivity;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\activitys\models\search\RelayapplicantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '报名人员列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relay-applicant-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--    <p>-->
    <!--        --><?//= Html::a('Create Applicant', ['create'], ['class' => 'btn btn-success']) ?>
    <!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            [
//                'label'=>'微信昵称',
//                'attribute' => 'wechat_id',
//                'value' => function ($model) {
//                    return WechatUser::getNickname($model->wechat_id);
//                },
//            ],

//            [
//                'label'=>'活动名称',
//                'attribute' => 'activity_id',
//                'filter' => Html::activeDropDownList(
//                    $searchModel,
//                    'activity_id',
//                    RelayActivity::gettArrayitle($searchModel->activity_id),
//                    ['class' => 'form-control', 'prompt' =>'请筛选']
//                ),
//                'value' => function ($model) {
//                    return RelayActivity::getTitle($model->activity_id);
//                },
//            ],
            'name',
            'mobilephone',
            'point',
            'datetime',
            // 'declaration',
            // 'imgurl:ntext',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>RelayActivity::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>
</div>


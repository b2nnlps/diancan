<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\sys\models\WechatUser;
use member\modules\activitys\models\RelayActivity;
use member\modules\activitys\models\RelayApplicant;
/* @var $this yii\web\View */
/* @var $searchModel member\modules\activitys\models\search\RelayrecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '助力记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relay-record-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                "headerOptions" => ["width" => "80"],
                'attribute' => 'id',
            ],
            [
                'label'=>'活动名称',
                'attribute' => 'activity_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'activity_id',
                    RelayActivity::gettArrayitle($searchModel->activity_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                ),
                'value' => function ($model) {
                    return RelayActivity::getTitle($model->activity_id);
                },
            ],
            [
                'label'=>'助力来自',
                'attribute' => 'from_user',
                'filter' =>FALSE,
                'value' => function ($model) {
                    return WechatUser::getNickname($model->from_user);
                },
            ],
            [
                'label'=>'助力给',
                'attribute' => 'to_user',
//                'filter' => $c_user,
                'value' => function ($model) {
                    $user=RelayApplicant::find()->where(['and',['wechat_id'=>$model['to_user'],'activity_id'=>$model['activity_id']]])->one();
                    return $user['name'];
                },
            ],
			   'point',
//            'from_user',
//            'to_user',
            'date',

            [
                'class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '100'],
                'template' => '{delete}'
            ],
        ],
    ]); ?>
</div>

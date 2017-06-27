<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\merchant\models\Member;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\merchant\models\search\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">

<!--    <p>-->
<!--        --><?//= Html::a('新增会员', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'rh_openid',
//            'uid',
            [
                'label'=>'微信昵称',
                'attribute' => 'wx_openid',
                'value' => function ($model) {
                    return \backend\modules\sys\models\WechatUser::getNickname($model->wx_openid);
                },
            ],
            'realname',
            [
                'label'=>'级别',
                'attribute' => 'rank',
                'filter' => Member::rank(),
                'value' => function ($model) {
                    return $model->rank($model->rank);
                },
            ],
            [
                'attribute' => 'phone',
                'value' => function ($model) {
                    return \common\models\ComModel::hidtel($model->phone);
                },
            ],
            // 'referrer',
            // 'ticket',
            // 'ticket_url:url',
            // 'headimg',
            // 'nickname',
            // 'sdasd',
            // 'province',
            // 'city',
            // 'district',
            [
                'attribute' => 'address',
                'value' => function ($model) {
                    return \common\models\ComModel::cut_str($model->address,30);
                },
            ],
            // 'remark',
//            [
//                'label'=>'推荐人',
//                'attribute' => 'referrer',
//                'filter' => Member::getrealname(),
//                'value' => function ($model) {
//                    return Member::getMemberName($model->referrer);
//                },
//            ],
            'created_time',
            // 'operator',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

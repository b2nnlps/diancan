<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\sys\models\Member;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sys\models\search\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增会员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
        [
            'label'=>'微信昵称',
            'attribute' => 'openid',
            'value' => function ($model) {
                return \backend\modules\sys\models\WechatUser::getNickname($model->openid);
            },
        ],
//            'openid',
            'realname',
             [
                'attribute' => 'phone',
                'value' => function ($model) {
                    return \common\models\ComModel::hidtel($model->phone);
                },
            ],
			 [
                'label'=>'级别',
                'attribute' => 'rank',
                'filter' => \backend\modules\sys\models\Member::rank(),
                'value' => function ($model) {
                    return $model->rank($model->rank);
                },
            ],
	       
//            'ticket',
           
            // 'headimgurl:url',
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
//             'status',
            // 'updated_by',
			 [
                'label'=>'推荐人',
                'attribute' => 'referrer',
                'filter' => Member::getrealname(),
                'value' => function ($model) {
                    return Member::getMemberName($model->referrer);
                },
            ],
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

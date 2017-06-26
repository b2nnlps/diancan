<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\sys\models\WechatUser;
/* @var $this yii\web\View */
/* @var $searchModel member\modules\sys\models\search\WechatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '微信用户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'openid',
            [
                'format' => ['image',['width'=>'35','height'=>'30']],
                'value'=>function ($model) {
                    return $model->headimgurl;
                },
                'label' => '头像',
            ],
            'nickname',
  //          [
   //             'label'=>'性别',
  //              'attribute' => 'sex',
  //              'value' => function ($model) {
   //                 return WechatUser::sex($model->sex);
   //             },
   //         ],
            'address',
//            [
//                'label'=>'关注公众号',
//                'attribute' => 'subscribe',
//                'value' => function ($model) {
//                    return WechatUser::subscribe($model->subscribe);
//                },
//            ],
//             'subscribe_time',
//             'remark',
            [
                'label'=>'所属模块',
                'attribute' => 'module',
                'value' => function ($model) {
                    return WechatUser::module($model->module);
                },
            ],
            [
                'attribute' => 'auth_time',
                'contentOptions'=>["style"=>'width:160px;'],
                'value' => function ($model) {
                    return date("Y-m-d H:i:s",$model->auth_time);
                },
            ],
            [
                'label'=>'用户类型',
                'attribute' => 'status',
                'value' => function ($model) {
                    return WechatUser::usertype($model->status);
                },
            ],
			'updated_time',
            ['class' => 'yii\grid\ActionColumn','header'=>'操作','headerOptions'=>['width'=>'100']],
        ],
    ]); ?>
</div>

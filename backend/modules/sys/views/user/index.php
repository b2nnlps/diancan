<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\sys\models\User;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sys\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'username',
            'realname',
            'phone',
            [
                'attribute' => 'modules',
//                "headerOptions" => ["width" => "100"],
                'filter' => User::modules(),
                'value' => function ($model) {
                    return $model->modules($model->modules);
                },
            ],
            // 'role',
            // 'email:email',
            // 'description',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' => User::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'creater',
            [
                'attribute' => 'created_at',
                'contentOptions'=>["style"=>'width:150px;'],
                'value' => function ($model) {
                    return date("Y.m.d H:i:s",$model->created_at);
                },
            ],
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => ['width' => '80'],
            ],
        ],
    ]); ?>
</div>

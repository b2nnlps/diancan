<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Wechat */

$this->title = $model->nickname;
$this->params['breadcrumbs'][] = ['label' => '微信用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechat-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->openid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->openid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'openid',
            'nickname',
            [
                'attribute'=>'headimgurl',
                'value'=>$model->headimgurl,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            [
                'label'=>'性别',
                'attribute' => 'sex',
                'value'=> $model->sex($model->sex),
            ],
            'address',
//            [
//                'label'=>'是否关注',
//                'attribute' => 'subscribe',
//                'value'=> $model->subscribe($model->subscribe),
//            ],
            [
                'label'=>'关注时间',
                'attribute' => 'subscribe_time',
            ],
            'remark',
            [
                'label'=>'所属模块',
                'attribute' => 'module',
                'value'=> $model->module($model->module),
            ],

            [
                'attribute' => 'auth_time',
                'value' => date("Y-m-d H:i:s",$model->auth_time),//日期时间格式化
            ],
            [
                'label'=>'用户类型',
                'attribute' => 'status',
                'value'=> $model->usertype($model->status),
            ],
			 'updated_time',
			 
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\Member */

$this->title = $model->realname;
$this->params['breadcrumbs'][] = ['label' => '会员列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-view">

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
            'realname',
            'phone',
            [
                'attribute' => 'referrer',
                'value'=> $model->getMemberName($model->referrer),
            ],
            [
                'attribute'=>'ticket',
                 'value'=>'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$model->ticket,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            [
                'attribute' => 'rank',
                'value'=> $model->rank($model->rank),
            ],
            'headimgurl:url',
            'nickname',
            'sdasd',
//            'province',
//            'city',
//            'district',
            'address',
            'remark',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            [
                'label'=>'更新人',
                'value'=>  \common\models\User::getUser($model->updated_by),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

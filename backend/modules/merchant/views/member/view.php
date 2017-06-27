<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Member */

$this->title = $model->realname;
$this->params['breadcrumbs'][] = ['label' => '会员列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$hobbyStr= explode(",", $model->hobby);
$hobby='';
foreach ($hobbyStr as  $val){
    $hobby.=\backend\modules\merchant\models\Member::hobby($val).',';
}
$hobby=rtrim($hobby, ",") ;//去掉最后一个“，”

?>
<div class="member-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'id',
            'rh_openid',
//            'uid',
            'wx_openid',
            'realname',
            [
                'attribute' => 'rank',
                'value'=> $model->rank($model->rank),
            ],
            'phone',
            [
                'attribute' => 'sex',
                'value' =>$model::sex($model->sex),
            ],
            [
                'attribute' => 'hobby',
                'value' => $hobby?$hobby:'暂无记录！',
            ],
//            [
//                'attribute' => 'referrer',
//                'value'=> $model->getMemberName($model->referrer),
//            ],
//            [
//                'attribute'=>'ticket',
//                'value'=>'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$model->ticket,
//                'format' => ['image',['width'=>'100','height'=>'100']],
//            ],
//            'ticket_url:url',
//            'headimg',
//            'nickname',
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
                'attribute' => 'operator',
                'value' =>$model::getMemberName($model->operator),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

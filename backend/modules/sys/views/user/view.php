<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\sys\models\User;
/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\user */

$this->title = $model->realname;
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'username',
            'realname',
            'phone',
            [
                'attribute' => 'modules',
                'value' =>User::modules($model->modules),
            ],
            'role',
            'email:email',
            'description',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            [
                'label'=>'更新人',
                'value'=>  \common\models\User::getUser($model->creater),
            ],
            [
                'attribute' => 'created_at',
                'value' => date("Y-m-d H:i:s",$model->created_at),//日期时间格式化
            ],
            [
                'attribute' => 'updated_at',
                'value' => date("Y-m-d H:i:s",$model->updated_at),
            ],
        ],
    ]) ?>

</div>

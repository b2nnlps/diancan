<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Loginlog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '登录日志列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loginlog-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'=>'登录用户',
                'value'=>  \common\models\User::getUser($model->u_id),
            ],
            [
                'attribute' => 'login_time',
                'value' => date("Y-m-d H:i:s",$model->login_time),//日期时间格式化
            ],
            'login_address',
            'login_ip',
            'login_equipment',
        ],
    ]) ?>

</div>

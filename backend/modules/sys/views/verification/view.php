<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\Verification */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '验证码列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verification-view">
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'=>'用户',
                'value'=>  \common\models\User::getUser($model->c_uid),
            ],
            'code',
            'phone',
            'time',
            'click',
            'totalclick',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
            ],
            'remarks',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\ShopStaff */

$this->title = $model->realname;
$this->params['breadcrumbs'][] = ['label' => '员工列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-staff-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '请确定要删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'phone',
            'openid',
            'username',
            'password',
            'realname',
            [
                'attribute' => 'shop_id',
                'value' => \member\modules\food\models\Shop::getShopName($model->shop_id),
            ],
            [
                'attribute' => 'role_id',
                'value' => $model::role($model->role_id),
            ],
            [
                'attribute' => 'status',
                'value' => $model::status($model->status),
            ],

            'created_time',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use member\modules\eshop\models\Sumpplier;
/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Cart */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '购物车列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-view">

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
            'session_id',
            'user_id',
            [
                'label'=>'用户',
                'attribute' => 'user_id',
                'value' =>\member\modules\sys\models\Member::getMemberName($model->user_id),
            ],
            [
                'label'=>'微信昵称',
                'attribute' => 'user_id',
                'value' => \member\modules\sys\models\WechatUser::getNickname($model->user_id),
            ],
            [
                'label'=>'商家',
                'attribute' => 'supplier_id',
                'value' =>Sumpplier::getName($model->supplier_id),
            ],
            'product_id',
            'sku',
            'name',
            'number',
            'price',
            [
                'attribute' => 'status',
                'value' => $model->status($model->status),
            ],
            'remark',
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Agent */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '代理商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-view">

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
            'user_id',
            [
                'label'=>'代理',
                'attribute' => 'user_id',
                'value' => \member\modules\sys\models\Member::getMemberName($model->user_id),
            ],
            [
                'label'=>'商品',
                'attribute' => 'product_id',
                'value' =>\member\modules\eshop\models\Product::getProductName($model->product_id),
            ],
            'product_id',
            'remark',
            [
                'attribute' => 'status',
                'value'=> $model->status($model->status),
            ],
            [
                'label'=>'创建人',
                'value'=>User::getUser($model->created_by),
            ],
            [
                'label'=>'更新人',
                'value'=>User::getUser($model->updated_by),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model backend\modules\merchant\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品分类列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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
            [
                'label'=>'所属商家',
                'attribute' => 'supplier_id',
                'value' =>\backend\modules\merchant\models\Supplier::getName($model->supplier_id),
            ],
            [
                'label'=>'上级类别',
                'attribute' => 'parent_id',
                'value' =>$model::getParent($model->parent_id),
            ],
            'name',
            'icon',
            'brief',
            [
                'attribute' => 'is_nav',
                'value' =>$model::is_nav($model->is_nav),
            ],
            'banner',
            'keywords',
            'description',
            'redirect_url:url',
            'sort_order',
            [
                'attribute' => 'status',
                'value' =>$model::status($model->status),
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

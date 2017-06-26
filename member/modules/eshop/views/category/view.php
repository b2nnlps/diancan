<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use member\modules\eshop\models\Category;
use member\modules\eshop\models\Sumpplier;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Category */

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
                'attribute' => 'supplier_id',
                'value' =>Sumpplier::getName($model->supplier_id),
            ],
            [
                'attribute' => 'parent_id',
                'value' =>Category::getParent($model->parent_id),
            ],
            'name',
            'icon',
            'brief',
            [
                'attribute' => 'is_nav',
                'value' =>Category::is_nav($model->is_nav),
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
                'value'=> User::getUser($model->created_by),
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

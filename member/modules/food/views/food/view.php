<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Food */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-view">


    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'class_id',
                'value' => \member\modules\food\models\Classes::getClassesName($model->class_id),
            ],
            [
                'attribute' => 'shop_id',
                'value' => \member\modules\food\models\Shop::getShopName($model->shop_id),
            ],
            'head_img',
            'img',

            [
                'attribute' => 'status',
                'value' => $model::status($model->status),
            ],
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>

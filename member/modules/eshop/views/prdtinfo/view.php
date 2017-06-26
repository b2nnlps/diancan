<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Prdtinfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '商品信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prdtinfo-view">

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
            'limit1',
            'price1',
            'limit2',
            'price2',
            'limit3',
            'price3',
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

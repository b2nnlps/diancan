<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model member\modules\member\models\MemberCard */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Member Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-card-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'shop_id',
            'title',
            'background',
            'description:ntext',
            'img',
            'bonus',
            'max_bonus',
            'created_time:datetime',
        ],
    ]) ?>

</div>

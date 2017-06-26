<?php

use yii\helpers\Html;
use yii\grid\GridView;
use member\modules\sys\models\Member;
use member\modules\sys\models\Address;
/* @var $this yii\web\View */
/* @var $searchModel member\modules\sys\models\search\AddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户地址列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增地址', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'用户名',
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return Member::getMemberName($model->user_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'user_id',
                    Member::getrealname($searchModel->user_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
//            'id',
//            'user_id',
            'consignee',
            [
                'attribute' => 'phone',
                'value' => function ($model) {
                    return \common\models\ComModel::hidtel($model->phone);
                },
            ],
//            'provinvce',
            // 'city',
            // 'district',
             'address',
            // 'zipcode',
            [
                'attribute' => 'default',
                'filter' =>Address::defaults(),
                'value' => function ($model) {
                    return $model->defaults($model->default);
                },
            ],
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>Address::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'updated_by',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\merchant\models\Member;
use backend\modules\merchant\models\Address;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\merchant\models\search\AddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户地址列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!---->
<!--    <p>-->
<!--        --><?//= Html::a('新增地址', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'label'=>'ID',
                'value' =>'id',
            ],
            [
                'label'=>'用户名',
                'attribute' => 'rh_openid',
                'value' => function ($model) {
                    return Member::getMemberName($model->rh_openid);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'rh_openid',
                    Member::getrealname($searchModel->rh_openid),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
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
            // 'address',
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
            // 'operator',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

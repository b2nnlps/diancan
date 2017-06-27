<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\merchant\models\Member;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\merchant\models\search\OrderstatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单状态';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'rh_openid',
            [
                'label'=>'操作员',
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
            'order_id',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>\backend\modules\merchant\models\Orderstatus::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
//            'remark',
            'time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

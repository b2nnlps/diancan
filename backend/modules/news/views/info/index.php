<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\eshop\models\Sumpplier;
use backend\modules\news\models\NewsInfo;
use backend\modules\news\models\NewsCategory;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\news\models\search\InfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '资讯列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-info-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建资讯', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=>'商家',
                'attribute' => 'supplier_id',
                'value' => function ($model) {
                    return Sumpplier::getName($model->supplier_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'supplier_id',
                    Sumpplier::getSumpplier($searchModel->supplier_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
            [
                'label' => '所属分类',
                'attribute' => 'cid',
//                "headerOptions" => ["width" => "80"],
                'filter' =>$list,
                'value' => function ($model) {
                    return NewsCategory::getCategoryName($model->cid);
                },
            ],
            'title',
//            'intro',
            // 'img',
            // 'carousel',
            // 'source',
            // 'source_url:url',
            // 'editor',
            // 'hret_status',
            // 'hret_url:url',
            // 'content:ntext',
             'pv',
            // 'praise',
            // 'collect',
            // 'transpond',
            [
                'attribute' => 'status',
//                "headerOptions" => ["width" => "80"],
                'filter' =>NewsInfo::status(),
                'value' => function ($model) {
                    return $model->status($model->status);
                },
            ],
            // 'uid',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\sys\models\Member;
use backend\modules\sys\models\WechatUser;
use backend\modules\eshop\models\Sumpplier;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\eshop\models\search\CartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '购物车列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('批量删除', '#', ['class' => 'btn btn-danger', 'id' => 'batchDelete']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'label'=>'微信昵称',
                'attribute' => 'openid',
                "headerOptions" => ["width" => "160"],
                'value' => function ($model) {
                    return WechatUser::getNickname($model->user_id);
                },
            ],
            'session_id',
            'id',

//            'user_id',
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
            'product_id',
            'name',
            'sku',
             'number',
             'price',
//             'status',
//             'remark',
             'created_time',
            // 'updated_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php
$urlBatchDelete = \yii\helpers\Url::to(['/eshop/cart/batch-delete']);
$js = <<<JS
jQuery(document).ready(function() {
    $("#batchDelete").click(function() {
        var keys = $("#w0").yiiGridView("getSelectedRows");
        if(window.confirm('你确定要删除选中的信息吗？')){
				$.ajax({
                    type: "POST",
                    url: "{$urlBatchDelete}",
                    dataType: "json",
                    data: {ids: keys}
                });
                 return true;
              }else{
                 return false;
             }
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_END);
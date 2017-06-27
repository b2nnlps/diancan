<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \backend\modules\merchant\models\Member;
use backend\modules\merchant\models\Supplier;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\merchant\models\search\CartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '购物车列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-body table-responsive no-padding">
    <p>
        <?= Html::a('批量删除', '#', ['class' => 'btn btn-danger', 'id' => 'batchDelete']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            'id',
            'session_id',
            [
                'label'=>'下单人',
                'attribute' => 'user_id',
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
            [
                'label'=>'商家',
                'attribute' => 'supplier_id',
                'value' => function ($model) {
                    return Supplier::getName($model->supplier_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'supplier_id',
                    Supplier::getSupplier($searchModel->supplier_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
            'product_id',
            'sku',
             'name',
             'number',
             'price',
            // 'status',
            // 'remark',
             'time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php
$urlBatchDelete = \yii\helpers\Url::to(['/merchant/cart/batch-delete']);
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
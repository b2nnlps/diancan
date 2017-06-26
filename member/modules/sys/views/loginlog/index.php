<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\sys\models\search\LoginlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '登录日志列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loginlog-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('批量删除', '#', ['class' => 'btn btn-danger', 'id' => 'batchDelete']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'label'=>'登录用户',
                'attribute' => 'u_id',
                'value' => function ($model) {
                    return \common\models\User::getUser($model->u_id);
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'u_id',
                    \common\models\User::getName($searchModel->u_id),
                    ['class' => 'form-control', 'prompt' =>'请筛选']
                )
            ],
//            'login_time:datetime',
            [
                'attribute' => 'login_time',
                'contentOptions'=>["style"=>'width:150px;'],
                'value' => function ($model) {
                    return date("Y-m-d H:i:s",$model->login_time);
                },
            ],
        //    'login_address',
            'login_ip',
//            'login_equipment',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions' => ['width' => '80'],
                'template' => '{view}&nbsp;&nbsp;&nbsp;&nbsp;{delete}'
            ],
        ],
    ]); ?>
</div>
<?php
$urlBatchDelete = \yii\helpers\Url::to(['/sys/loginlog/batch-delete']);
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
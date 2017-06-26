<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use member\modules\eshop\models\Product;
use member\modules\eshop\models\Category;
use member\modules\eshop\models\Sumpplier;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model member\modules\eshop\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">


    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="tabbable" id="tabs-407966">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#panel-679925" data-toggle="tab">商品详情</a>
                        </li>
                        <li>
                            <a href="#panel-4603" data-toggle="tab">商品其他信息</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="panel-679925">
                            </br>
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
                                    [
                                        'attribute' => 'supplier_id',
                                        'value' =>Sumpplier::getName($model->supplier_id),
                                    ],
                                    [
                                        'attribute' => 'category_id',
                                        'value' =>Category::getParent($model->category_id),
                                    ],
                                    'name',
                                    [
                                        'attribute' => 'pattern',
                                        'value' =>Product::pattern($model->pattern),
                                    ],
                                    'sku',
                                    'stock',
                                    'sales',
                                    'pv',
                                    'market_price',
                                    'price',
                                    'thumb',
//                                    'image:ntext',
                                    'keywords',
                                    'brief',
//                                    'content:ntext',
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
                                        'value'=> User::getUser($model->updated_by),
                                    ],
                                    'created_time',
                                    'updated_time',
                                ],
                            ]) ?>
                        </div>
                        <div class="tab-pane" id="panel-4603">
                            <p>
                                第二部分内容.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

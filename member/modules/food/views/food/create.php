<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\food\models\Food */
$cookies = Yii::$app->request->cookies;

$this->title = '添加菜品('.$cookies->getValue('shop_name','空').')';
$this->params['breadcrumbs'][] = ['label' => 'Foods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

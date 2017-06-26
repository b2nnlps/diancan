<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\Link */

$this->title = '创建 Link';
$this->params['breadcrumbs'][] = ['label' => 'Links 列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

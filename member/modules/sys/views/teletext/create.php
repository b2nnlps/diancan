<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Teletext */

$this->title = '创建图文';
$this->params['breadcrumbs'][] = ['label' => '图文列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teletext-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model member\modules\sys\models\Member */

$this->title = '新增会员';
$this->params['breadcrumbs'][] = ['label' => '会员列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

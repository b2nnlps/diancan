<?php

namespace frontend\controllers;

use backend\modules\sys\models\District;
use Yii;


class RegionController extends \frontend\components\Controller
{
    /**
     * List Region Children for select
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionAjaxListChild($id)
    {
        //'visible' => Yii::$app->user->can('deleteYourAuth'),

        $countChild = District::find()->where(['parent_id' => $id])->count();
        $children = District::find()->where(['parent_id' => $id])->all();

        if($countChild > 0)
        {
            echo "<option>" . '请选择' . "</option>";
            foreach($children as $child)
                echo "<option value='" . $child->id . "'>" . $child->name . "</option>";
        }
        else
        {
            echo "<option>" .  '请选择'. "</option>";
        }
    }

}

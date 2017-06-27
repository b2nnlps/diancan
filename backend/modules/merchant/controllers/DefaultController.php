<?php

namespace backend\modules\merchant\controllers;

use yii\web\Controller;
use backend\controllers\BaseController;
/**
 * Default controller for the `merchant` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}

<?php

namespace frontend\modules\eshop;

/**
 * eshop module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\eshop\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout=FALSE;
        // custom initialization code goes here
    }
}

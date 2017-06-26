<?php

namespace frontend\modules\activitys;

/**
 * activitys module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\activitys\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout=false;
        // custom initialization code goes here
    }
}

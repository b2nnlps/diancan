<?php

namespace frontend\modules\merchant;

/**
 * merchant module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\merchant\controllers';

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

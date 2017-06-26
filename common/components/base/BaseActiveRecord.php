<?php

namespace common\components\base;




class BaseActiveRecord extends \yii\db\ActiveRecord
{
  /**
   * 输出验证之后错误信息
   */
    public function afterValidate()
    {
	parent::afterValidate();
	if($this->hasErrors())
	{
//	    var_dump($this->errors);
	}
    }
    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            if($this->hasAttribute('created_time')){
                $this->setAttribute('created_time',date('Y-m-d H:i:s'));
            }
            if($this->hasAttribute('updated_time')){
                $this->setAttribute('updated_time',date('Y-m-d H:i:s'));
            }
        }else{
            if($this->hasAttribute('updated_time')){
                $this->setAttribute('updated_time',date('Y-m-d H:i:s'));
            }
        }
        return parent::beforeSave($insert);
    }
    
}

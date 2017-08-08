<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_feedback".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property string $user
 * @property string $text
 * @property integer $created_time
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'user', 'text', 'created_time'], 'required'],
            [['shop_id', 'created_time'], 'integer'],
            [['text'], 'string'],
            [['user'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => '商家ID',
            'user' => '反馈用户',
            'text' => '反馈内容',
            'created_time' => '反馈时间',
        ];
    }
}

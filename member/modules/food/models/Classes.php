<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_classes".
 *
 * @property integer $id
 * @property string $name
 * @property integer $shop_id
 * @property string $updated_time
 * @property string $created_time
 */
class Classes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_classes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'shop_id', 'updated_time', 'created_time'], 'required'],
            [['shop_id'], 'integer'],
            [['updated_time', 'created_time'], 'safe'],
            [['name'], 'string', 'max' => 80],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名字',
            'img' => '分类图片',
            'shop_id' => 'Shop ID',
            'created_time' => 'Created Time',
        ];
    }
}

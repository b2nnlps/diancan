<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_food_info".
 *
 * @property integer $id
 * @property string $title
 * @property double $price
 * @property integer $food_id
 */
class FoodInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_food_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'price', 'food_id'], 'required'],
            [['price'], 'number'],
            [['food_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'price' => 'Price',
            'food_id' => 'Food ID',
        ];
    }
}

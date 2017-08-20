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
            [['food_id', 'shop_id', 'price', 'unit'], 'required'],
            [['price'], 'number'],
            [['shop_id', 'food_id', 'number', 'status'], 'integer'],
            [['title', 'unit'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '规格名称',
            'unit' => '单位',
            'price' => '价格',
            'food_id' => '商品ID',
        ];
    }

    public static function newInfo($title, $unit, $price, $score, $number, $shop_id, $food_id)
    {
        $info=new self();
        $info->title=$title;
        $info->unit = $unit;
        $info->price=$price;
        $info->score=$score;
        $info->number=$number;
        $info->shop_id = $shop_id;
        $info->food_id=$food_id;
        $info->save();
    }
}

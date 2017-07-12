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
            [['title', 'price','number', 'food_id'], 'required'],
            [['price'], 'number'],
            [['food_id','number','status'], 'integer'],
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
    public static function newInfo($title,$price,$score,$number,$food_id){
        $info=new self();
        $info->title=$title;
        $info->price=$price;
        $info->score=$score;
        $info->number=$number;
        $info->food_id=$food_id;
        $info->save();
    }
}

<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_order_info".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $food_id
 * @property integer $price
 * @property integer $num
 * @property string $type
 * @property string $text
 * @property integer $status
 */
class OrderInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_order_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'food_id', 'price', 'num', 'type', 'text'], 'required'],
            [['order_id', 'food_id', 'price', 'num', 'status'], 'integer'],
            [['text'], 'string'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'food_id' => 'Food ID',
            'price' => '价格（分）',
            'num' => '数量',
            'type' => '类型',
            'text' => '要求备注',
            'status' => '0待上菜',
        ];
    }
}

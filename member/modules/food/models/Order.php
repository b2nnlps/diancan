<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_order".
 *
 * @property integer $id
 * @property integer $num
 * @property string $user
 * @property integer $shop_id
 * @property string $orderno
 * @property string $text
 * @property integer $type
 * @property integer $print
 * @property integer $status
 * @property string $created_time
 * @property string $updated_time
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num', 'shop_id', 'status','print'], 'integer'],
            [['shop_id', 'orderno', 'status', 'created_time', 'updated_time'], 'required'],
            [['text'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['user'], 'string', 'max' => 255],
            [['orderno','table'], 'string', 'max' => 100],
            [['phone','realname'], 'string', 'max' => 20],
            [['total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num' => '今日订单号',
            'user' => 'User',
            'shop_id' => '店家',
            'phone' => '手机号码',
            'realname' => '姓名',
            'table' => '桌号',
            'total' => '总价',
            'orderno' => 'Orderno',
            'text' => '备注',
            'status' => '0待支付1已支付2已完成',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }
}

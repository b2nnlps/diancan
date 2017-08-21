<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_device".
 *
 * @property integer $id
 * @property string $device_id
 * @property integer $order_id
 * @property integer $status
 * @property string $updated_time
 * @property string $created_time
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_device';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id', 'order_id', 'created_time'], 'required'],
            [['status'], 'integer'],
            [['updated_time', 'created_time'], 'safe'],
            [['device_id', 'order_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_id' => '打印机编号',
            'order_id' => '订单号',
            'status' => '打印状态0未打印1已打印2打印失败',
            'updated_time' => '打印时间',
            'created_time' => '创建时间',
        ];
    }

    public static function newDevice($device_id, $order_id)
    {
        $device = new self();
        $device->device_id = $device_id;
        $device->order_id = $order_id;
        $device->created_time = date("Y-m-d H:i:s");
        $device->save();
    }
}

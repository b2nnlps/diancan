<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_table".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property string $table
 * @property string $device_id
 */
class Table extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'table', 'device_id'], 'required'],
            [['shop_id'], 'integer'],
            [['table', 'device_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => '商家id',
            'table' => '桌号',
            'device_id' => '桌号对应的打印机',
        ];
    }

    public static function sendByTable($shop, $table)
    {

    }
}

<?php

namespace backend\modules\eshop\models;

use Yii;

/**
 * This is the model class for table "{{%eshop_stock}}".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $depot_id
 * @property integer $supplier_id
 * @property integer $stock
 * @property integer $sales
 * @property integer $status
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Stock extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eshop_stock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'depot_id', 'supplier_id'], 'required'],
            [['product_id', 'depot_id', 'supplier_id', 'stock', 'sales', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'depot_id' => '库房ID',
            'supplier_id'=>'商家ID',
            'product_id' => '商品ID',
            'stock' => '库存',
            'sales' => '出库量',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_by' => '更新人',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
        ];
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '可用',
            '2' => '禁用',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

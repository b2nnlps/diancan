<?php

namespace member\modules\eshop\models;

use Yii;

/**
 * This is the model class for table "{{%eshop_orderproduct}}".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $supplier_id
 * @property string $sku
 * @property string $name
 * @property integer $number
 * @property string $price
 * @property string $amount
 * @property integer $status
 * @property string $remark
 * @property string $created_time
 * @property string $updated_time
 */
class Orderproduct extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eshop_orderproduct}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id', 'product_id', 'number', 'price'], 'required'],
            [['order_id','supplier_id', 'product_id', 'number', 'status'], 'integer'],
            [['price', 'amount'], 'number'],
            [['created_time', 'updated_time'], 'safe'],
            [['user_id', 'sku', 'name', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'order_id' => '订单ID',
            'product_id' => '商品ID',
            'supplier_id' => '商家ID',
            'sku' => '单位',
            'name' => '名称',
            'number' => '数量',
            'price' => '单价',
            'amount' => '总额',
            'status' => '状态',
            'remark' => '备注',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
    public static function status($key = null)
    {
        $arr = [
			'10' => '可用',
            '0' => '已取消',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

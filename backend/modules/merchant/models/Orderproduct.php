<?php

namespace backend\modules\merchant\models;

use Yii;

/**
 * This is the model class for table "{{%merchant_orderproduct}}".
 *
 * @property integer $id
 * @property string $rh_openid
 * @property integer $supplier_id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $name
 * @property string $sku
 * @property integer $number
 * @property string $price
 * @property string $amount
 * @property integer $status
 * @property string $remark
 * @property string $time
 */
class Orderproduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant_orderproduct}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'order_id', 'product_id', 'number', 'status'], 'integer'],
            [['order_id', 'product_id', 'name', 'sku'], 'required'],
            [['price', 'amount'], 'number'],
            [['time'], 'safe'],
            [['rh_openid', 'name', 'remark'], 'string', 'max' => 255],
            [['sku'], 'string', 'max' => 68],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '订单商品ID',
            'rh_openid' => '会员OpenId',
            'supplier_id' => '商家ID',
            'order_id' => '订单ID',
            'product_id' => '商品ID',
            'name' => '商品名称',
            'sku' => '单位',
            'number' => '数量',
            'price' => '单价',
            'amount' => '总额',
            'status' => '状态',
            'remark' => '备注',
            'time' => '下单时间',
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

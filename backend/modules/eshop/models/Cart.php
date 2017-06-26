<?php

namespace backend\modules\eshop\models;

use Yii;

/**
 * This is the model class for table "{{%eshop_cart}}".
 *
 * @property integer $id
 * @property string $session_id
 * @property string $user_id
 * @property integer $product_id
 * @property integer $supplier_id
 * @property string $sku
 * @property string $name
 * @property integer $number
 * @property string $price
 * @property integer $status
 * @property string $remark
 * @property string $created_time
 * @property string $updated_time
 */
class Cart extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eshop_cart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['session_id', 'product_id'], 'required'],
            [['product_id', 'supplier_id','number', 'status'], 'integer'],
            [['price'], 'number'],
            [['created_time', 'updated_time'], 'safe'],
            [['session_id', 'user_id', 'name', 'remark'], 'string', 'max' => 255],
            [['sku'], 'string', 'max' => 68],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_id' => 'Session',
            'user_id' => '用户ID',
            'product_id' => '商品ID',
            'supplier_id' => '商家ID',
            'sku' => '单位',
            'name' => '名称',
            'number' => '数量',
            'price' => '单价',
            'status' => '状态',
            'remark' => '备注',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
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

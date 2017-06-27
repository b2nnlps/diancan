<?php

namespace backend\modules\merchant\models;

use Yii;

/**
 * This is the model class for table "{{%merchant_cart}}".
 *
 * @property integer $id
 * @property string $session_id
 * @property string $rh_openid
 * @property integer $supplier_id
 * @property integer $product_id
 * @property string $sku
 * @property string $name
 * @property integer $number
 * @property string $price
 * @property integer $status
 * @property string $remark
 * @property string $time
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant_cart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['session_id', 'rh_openid', 'supplier_id'], 'required'],
            [['supplier_id',  'product_id','number', 'status'], 'integer'],
            [['price'], 'number'],
            [['time'], 'safe'],
            [['session_id', 'rh_openid', 'name', 'remark'], 'string', 'max' => 255],
            [['sku'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '购物车ID',
            'session_id' => 'Session',
            'rh_openid' => '会员OpenId',
            'supplier_id' => '商家ID',
            'product_id' => '商品',
            'sku' => '单位',
            'name' => '名称',
            'number' => '数量',
            'price' => '单价',
            'status' => '状态',
            'remark' => '备注',
            'time' => '添加时间',
        ];
    }
}

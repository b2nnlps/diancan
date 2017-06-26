<?php

namespace member\modules\eshop\models;

use Yii;

/**
 * This is the model class for table "{{%eshop_orderstatus}}".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $status
 * @property string $remark
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Orderstatus extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eshop_orderstatus}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id', 'product_id', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['user_id', 'remark', 'created_by', 'updated_by'], 'string', 'max' => 255],
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
            'status' => '状态',
            'remark' => '备注',
            'created_by' => '创建人',
            'updated_by' => '修改人',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '待商家接单',
            '2' => '商家已接单',
            '3' => '订单已配送',
            '4' => '订单已成交',
            '5' => '订单已取消',
        ];
        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

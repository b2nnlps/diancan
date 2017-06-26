<?php

namespace member\modules\eshop\models;

use Yii;

/**
 * This is the model class for table "{{%eshop_order}}".
 *
 * @property integer $id
 * @property string $sn
 * @property string $user_id
 * @property string $referrer
 * @property string $consignee
 * @property string $phone
 * @property string $amount
 * @property string $zipcode
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $remark
 * @property integer $payment_method
 * @property integer $payment_status
 * @property string $shipment_id
 * @property integer $status
 * @property integer $clearing
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Order extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eshop_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'consignee', 'phone', 'amount', 'address'], 'required'],
            [['amount'], 'number'],
            [['province', 'city', 'district', 'payment_method', 'payment_status', 'clearing', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['sn', 'user_id', 'referrer', 'address', 'remark', 'shipment_id','updated_by'], 'string', 'max' => 255],
            [['consignee'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 32],
            [['zipcode'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sn' => '订单号',
            'user_id' => '用户Openid',
            'referrer' => '推荐人Openid',
            'consignee' => '收件人',
            'phone' => '手机号码',
            'amount' => '总额',
            'zipcode' => '邮政编码',
            'province' => '省',
            'city' => '市',
            'district' => '县/区',
            'address' => '详细地址',
            'remark' => '备注',
            'payment_method' => '支付方式',
            'payment_status' => '支付状态',
            'shipment_id' => '配送ID',
            'clearing' => '是否结算',
            'status' => '状态',
            'updated_by' => '更新人',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
    public static function method($key = null)
    {
        $arr = [
            '1' => '货到付款',
            '2' => '在线支付',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function payment_status($key = null)
    {
        $arr = [
            '1' => '未付款',
            '2' => '已付款',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
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
    public static function clearing($key = null)
    {
        $arr = [
            '1' => '未结算',
            '2' => '已结算',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
	public static function shipment_id($key = null)
    {
        $arr = [
            '1' => '商家配送',
            '2' => '物流配送',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

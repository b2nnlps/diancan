<?php

namespace backend\modules\merchant\models;

use Yii;

/**
 * This is the model class for table "{{%merchant_order}}".
 *
 * @property integer $id
 * @property string $rh_openid
 * @property string $sn
 * @property integer $supplier_id
 * @property string $referrer
 * @property string $consignee
 * @property string $phone
 * @property string $amount
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $zipcode
 * @property string $receive_time
 * @property string $remark
 * @property integer $payment_method
 * @property integer $payment_status
 * @property integer $receiv_status
 * @property integer $shipment_status
 * @property integer $shipment_id
 * @property integer $clearing
 * @property integer $status
 * @property string $operator
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
        return '{{%merchant_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'province', 'city', 'district', 'payment_method', 'payment_status', 'receiv_status', 'shipment_status', 'shipment_id', 'clearing', 'status'], 'integer'],
            [['consignee', 'phone', 'address'], 'required'],
            [['amount'], 'number'],
            [['receive_time', 'created_time', 'updated_time'], 'safe'],
            [['rh_openid', 'sn', 'referrer', 'consignee', 'address','remark', 'operator'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 32],
            [['zipcode'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '订单ID',
            'rh_openid' => '会员OpenId',
            'sn' => '订单号',
            'supplier_id' => '商家ID',
            'referrer' => '推荐人',
            'consignee' => '收件人',
            'phone' => '手机号码',
            'amount' => '订单总额',
            'province' => '省',
            'city' => '市',
            'district' => '县/区',
            'address' => '详细地址',
            'zipcode' => '邮政编码',
            'receive_time' => '取货时间',
            'remark' => '备注',
            'payment_method' => '支付方式',
            'payment_status' => '支付状态',
            'receiv_status' => '接单状态',
            'shipment_status' => '配送状态',
            'shipment_id' => '配送ID',
            'clearing' => '是否结算',
            'status' => '状态',
            'operator' => '操作员',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
    public static function method($key = null)
    {
        $arr = [
            '1' => '货到付款',
            '2' => '线下付款',
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
            '5' => '订单已取消',//当已接单时，取消订单同步增加可预订库存和减销量
            '6' => '订单已取消',//当订单已配送时，取消订单同步增加可预订库存和真实库存，减销量
            '7' => '订单已取消',//当商家未接单时，取消订单不增减库存和销量
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
	
	  public static function shipment_status($key = null)
    {
        $arr = [
            '1' => '未取货',
            '2' => '已取货',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

}

<?php

namespace backend\modules\merchant\models;

use Yii;

/**
 * This is the model class for table "{{%merchant_orderstatus}}".
 *
 * @property integer $id
 * @property string $rh_openid
 * @property integer $order_id
 * @property integer $status
 * @property string $remark
 * @property string $time
 */
class Orderstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant_orderstatus}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id', 'status'], 'integer'],
            [['time'], 'safe'],
            [['rh_openid', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '订单状态ID',
            'rh_openid' => '会员OpenId',
            'order_id' => '订单ID',
            'status' => '状态',
            'remark' => '备注',
            'time' => '操作时间',
        ];
    }
     public static function status($key = null)
    {
        $arr = [
            '1' => '未付款',
            '2' => '已付款',
            '3' => '已取货',
            '4' => '已成交',
        ];

        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
//    public static function status($key = null)
//    {
//        $arr = [
//            '1' => '待商家接单',
//            '2' => '商家已接单',
//            '3' => '订单已配送',
//            '4' => '订单已成交',
//            '5' => '订单已取消',//当已接单时，取消订单同步增加可预订库存和减销量
//            '6' => '订单已取消',//当订单已配送时，取消订单同步增加可预订库存和真实库存，减销量
//            '7' => '订单已取消',//当商家未接单时，取消订单不增减库存和销量
//        ];
//
//        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
//    }
}

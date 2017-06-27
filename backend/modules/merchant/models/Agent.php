<?php

namespace backend\modules\merchant\models;

use Yii;

/**
 * This is the model class for table "{{%merchant_agent}}".
 *
 * @property integer $id
 * @property string $rh_openid
 * @property integer $supplier_id
 * @property integer $product_id
 * @property integer $stock
 * @property integer $bookable
 * @property integer $sales
 * @property integer $pv
 * @property string $market_price
 * @property string $price
 * @property string $remark
 * @property integer $status
 * @property string $operator
 * @property string $created_time
 * @property string $updated_time
 */
class Agent extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant_agent}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'product_id', 'stock', 'bookable', 'sales', 'pv', 'status'], 'integer'],
            [['market_price', 'price'], 'number'],
//            [[ 'product_id',], 'required'],
            [['created_time', 'updated_time'], 'safe'],
            [['rh_openid', 'remark', 'operator'], 'string', 'max' => 255],
            [['pv', 'stock', 'bookable','sales','status'],'default','value'=>0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '代理商品ID',
            'rh_openid' => '会员OpenId',
            'supplier_id' => '代理商ID',
            'product_id' => '代理商品ID',
            'stock' => '库存',
            'bookable' => '可预订库存',
            'sales' => '销量',
            'pv' => '访问量',
            'market_price' => '市场价',
            'price' => '售价',
            'remark' => '备注',
            'status' => '状态',
            'operator' => '操作员',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
    public static function status($key=null){
        $arr=[
            '1'=>'上架',
            '0'=>'下架',
        ];
        return $key===null?$arr:(isset($arr[$key])?$arr[$key]:'');
    }
    
}

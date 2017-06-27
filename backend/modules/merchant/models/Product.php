<?php

namespace backend\modules\merchant\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%merchant_product}}".
 *
 * @property integer $id
 * @property string $rh_openid
 * @property integer $supplier_id
 * @property integer $category_id
 * @property string $name
 * @property string $code
 * @property string $labels
 * @property string $sku
 * @property integer $stock
 * @property integer $bookable
 * @property integer $sales
 * @property integer $pv
 * @property string $market_price
 * @property string $price
 * @property string $thumb
 * @property string $image
 * @property string $brief
 * @property string $content
 * @property integer $status
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Product extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'category_id', 'stock', 'bookable', 'sales', 'pv', 'status'], 'integer'],
            [['name', 'sku', 'thumb', 'image', 'brief', 'content','market_price', 'price'], 'required'],
            [['market_price', 'price'], 'number'],
            [['image', 'content'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['rh_openid', 'name', 'code', 'labels', 'thumb', 'brief', 'created_by', 'updated_by'], 'string', 'max' => 255],
            [['sku'], 'string', 'max' => 68],
            [['pv', 'stock', 'bookable', 'sales'],'default','value'=>0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rh_openid' => '会员OpenId',
            'supplier_id' => '商家ID',
            'category_id' => '分类',
            'name' => '商品名称',
            'code' => '查询码',
            'labels' => '标签',
            'sku' => '单位',
            'stock' => '库存',
            'bookable' => '可预订库存',
            'sales' => '销量',
            'pv' => '访问量',
            'market_price' => '市场价',
            'price' => '售价',
            'thumb' => '商品封面',
            'image' => '商品图片',
            'brief' => '简述',
            'content' => '商品详情',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_by' => '修改人',
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
    public static function getProductName($id)
    {
        $model = self::findOne($id);
        $name=$model['name'];
        return $name?$name:'无';
    }
    public static function getProduct()
    {
        $model =ArrayHelper::map(self::find()->where(['status'=>1])->asArray()->all(), 'id', 'name');
        return $model;
    }
    
}

<?php

namespace backend\modules\eshop\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%eshop_product}}".
 *
 * @property integer $id
 * @property integer $supplier_id
 * @property integer $category_id
 * @property string $name
 * @property integer $pattern
 * @property string $sku
 * @property integer $stock
 * @property integer $sales
 * @property integer $pv
 * @property string $market_price
 * @property string $price
 * @property string $thumb
 * @property string $image
 * @property string $keywords
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
        return '{{%eshop_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'category_id', 'pattern', 'stock', 'sales', 'pv', 'status'], 'integer'],
            [['name', 'pattern', 'sku', 'thumb', 'image','sales','brief', 'content'], 'required'],
            [['market_price', 'price'], 'number'],
            [['image', 'content'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'sku', 'thumb', 'keywords', 'brief', 'created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supplier_id' => '商家ID',
            'category_id' => '商品分类',
            'name' => '商品名称',
            'pattern' => '模式',
            'sku' => '单位',
            'stock' => '库存',
            'sales' => '销售量',
            'pv' => '浏览量',
            'market_price' => '市场价',
            'price' => '会员价',
            'thumb' => '商品封面',
            'image' => '商品图片',
            'keywords' => '关键字',
            'brief' => '简述',
            'content' => '商品详情',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_by' => '修改人',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
        ];
    }
    public static function pattern($key = null)
    {
        $arr = [
            '1' => '通用',
            '2' => '分额度',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
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

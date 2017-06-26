<?php

namespace backend\modules\eshop\models;

use Yii;

/**
 * This is the model class for table "{{%eshop_prdtinfo}}".
 *
 * @property integer $id
 * @property integer $limit1
 * @property string $price1
 * @property integer $limit2
 * @property string $price2
 * @property integer $limit3
 * @property string $price3
 * @property integer $status
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Prdtinfo extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eshop_prdtinfo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id', 'limit1', 'price1', 'limit2', 'price2', 'limit3', 'price3'], 'required'],
            [['id', 'limit1', 'limit2', 'limit3', 'status'], 'integer'],
            [['price1', 'price2', 'price3'], 'number'],
            [['created_time', 'updated_time'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'limit1' => '额度1',
            'price1' => '价格1',
            'limit2' => '额度2',
            'price2' => '价格2',
            'limit3' => '额度3',
            'price3' => '价格3',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_by' => '修改人',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
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

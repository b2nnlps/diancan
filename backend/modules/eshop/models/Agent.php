<?php

namespace backend\modules\eshop\models;

use Yii;

/**
 * This is the model class for table "{{%eshop_agent}}".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $product_id
 * @property string $remark
 * @property integer $status
 * @property string $created_by
 * @property string $updated_by
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
        return '{{%eshop_agent}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'required'],
            [['product_id', 'status'], 'integer'],
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
            'product_id' => '代理商品',
            'remark' => '备注',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_by' => '修改人',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
        ];
    }
    public static function status($key=null){
        $arr=[
            '1'=>'已提交申请',
            '2'=>'系统受理中',
            '3'=>'申请成功',
            '4'=>'申请失败',
        ];
        return $key===null?$arr:(isset($arr[$key])?$arr[$key]:'');
    }
}

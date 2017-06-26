<?php

namespace backend\modules\sys\models;

use Yii;

/**
 * This is the model class for table "{{%sys_address}}".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $consignee
 * @property string $phone
 * @property integer $provinvce
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $zipcode
 * @property integer $default
 * @property integer $status
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Address extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'consignee', 'phone', 'address'], 'required'],
            [['provinvce', 'city', 'district', 'default', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['user_id', 'consignee', 'phone', 'address', 'updated_by'], 'string', 'max' => 255],
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
            'user_id' => '用户Openid',
            'consignee' => '收件人',
            'phone' => '联系电话',
            'provinvce' => '省',
            'city' => '市',
            'district' => '县/区',
            'address' => '详细地址',
            'zipcode' => '邮编',
            'default' => '是否默认',
            'status' => '状态',
            'updated_by' => '修改人',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
        ];
    }
    public static function defaults($key=null){
        $arr=[
            '1'=>'否',
            '10'=>'是',
        ];
        return $key===null?$arr:(isset($arr[$key])?$arr[$key]:'');
    }
    public static function status($key=null){
        $arr=[
            '1'=>'可用',
            '2'=>'禁用',
        ];
        return $key===null?$arr:(isset($arr[$key])?$arr[$key]:'');
    }
}

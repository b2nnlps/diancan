<?php

namespace backend\modules\merchant\models;

use Yii;

/**
 * This is the model class for table "{{%merchant_address}}".
 *
 * @property integer $id
 * @property string $rh_openid
 * @property string $consignee
 * @property string $phone
 * @property integer $provinvce
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $zipcode
 * @property integer $default
 * @property integer $status
 * @property string $operator
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
        return '{{%merchant_address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['consignee', 'phone', 'address'], 'required'],
            [['provinvce', 'city', 'district', 'default', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['rh_openid', 'consignee', 'phone', 'address', 'operator'], 'string', 'max' => 255],
            [['zipcode'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '地址ID',
            'rh_openid' => '会员OpenId',
            'consignee' => '收件人',
            'phone' => '联系电话',
            'provinvce' => '省',
            'city' => '市',
            'district' => '县/区',
            'address' => '详细地址',
            'zipcode' => '邮编',
            'default' => '是否默认',
            'status' => '状态',
            'operator' => '操作员',
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

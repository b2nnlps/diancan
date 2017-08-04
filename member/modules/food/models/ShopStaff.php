<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_shop_staff".
 *
 * @property integer $id
 * @property string $phone
 * @property string $openid
 * @property string $username
 * @property string $password
 * @property integer $shop_id
 * @property integer $role_id
 * @property integer $status
 * @property string $created_time
 */
class ShopStaff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_shop_staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'username', 'password', 'shop_id', 'role_id', 'created_time'], 'required'],
            [['shop_id', 'role_id', 'status'], 'integer'],
            [['created_time'], 'safe'],
            [['phone'], 'string', 'max' => 20],
            [['openid'], 'string', 'max' => 80],
            [['username', 'password','realname'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => '手机号码',
            'openid' => 'Openid',
            'username' => '员工账户',
            'password' => '员工密码',
            'realname' => '员工姓名',
            'shop_id' => '所属商家',
            'role_id' => '职务',
            'status' => '状态',
            'created_time' => '创建时间',
        ];
    }

    public static function role($key = null)
    {
        $arr = [
            '0' => '厨房',
            '1' => '店员',
            '2' => '经理',
            '3' => '收银',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    public static function status($key = null)
    {
        $arr = [
            '0' => '正常',
            '1' => '停用',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

<?php

namespace backend\modules\food\models;

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
            [['openid', 'username', 'password', 'shop_id', 'role_id', 'created_time'], 'required'],
            [['shop_id', 'role_id'], 'integer'],
            [['created_time'], 'safe'],
            [['phone'], 'string', 'max' => 20],
            [['openid'], 'string', 'max' => 80],
            [['username', 'password'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'openid' => 'Openid',
            'username' => '员工账户',
            'password' => '员工密码',
            'shop_id' => 'Shop ID',
            'role_id' => '0厨房1店员2经理3收银',
            'created_time' => 'Created Time',
        ];
    }
}

<?php

namespace backend\modules\sys\models;

use Yii;

/**
 * This is the model class for table "{{%sys_loginlog}}".
 *
 * @property integer $id
 * @property string $u_id
 * @property integer $login_time
 * @property string $login_address
 * @property string $login_ip
 * @property string $login_equipment
 */
class Loginlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_loginlog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'login_time'], 'required'],
            [['login_time'], 'integer'],
            [['u_id', 'login_address', 'login_ip', 'login_equipment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'u_id' => '登录ID',
            'login_time' => '登录时间',
            'login_address' => '登录地点',
            'login_ip' => '登录IP',
            'login_equipment' => '登录设备',
        ];
    }
}

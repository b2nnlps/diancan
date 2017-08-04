<?php

namespace member\modules\sys\models;

use Yii;

/**
 * This is the model class for table "{{%sys_user}}".
 *
 * @property string $id
 * @property string $username
 * @property string $realname
 * @property string $phone
 * @property integer $modules
 * @property integer $role
 * @property string $email
 * @property string $description
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property string $creater
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \common\models\User
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','realname', 'phone','email', ], 'required', 'on' => ['admin-create', 'admin-update']],
            [['password', 'repassword'], 'required', 'on' => ['admin-create']],
            [['password', 'repassword', 'oldpassword'], 'required', 'on' => ['admin-change-password']],
            [['username', 'email', 'password', 'repassword'], 'trim', 'on' => ['admin-create', 'admin-update']],
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30, 'on' => ['admin-create', 'admin-update']],
            [['password', 'repassword', 'oldpassword'], 'string', 'min' => 6, 'max' => 30, 'on' => ['admin-change-password']],
            [['username', 'email'], 'unique', 'on' => ['admin-create', 'admin-update']],
//            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '该用户名已被占用!'],
            ['username', 'string', 'min' => 3, 'max' => 30, 'on' => ['admin-create', 'admin-update']],
            ['email', 'string', 'max' => 100, 'on' => ['admin-create', 'admin-update']],
            ['email', 'email', 'on' => ['admin-create', 'admin-update']],
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            ['oldpassword', 'validateOldPassword', 'on' => ['admin-change-password']],
            [['modules', 'role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['realname', 'phone', 'description', 'creater' ], 'string', 'max' => 255],

//            [['id', 'username', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
//            [['modules', 'role', 'status', 'created_at', 'updated_at'], 'integer'],
//            [['id', 'username', 'realname', 'phone', 'email', 'description', 'password_hash', 'password_reset_token', 'creater'], 'string', 'max' => 255],
//            [['auth_key'], 'string', 'max' => 32],
//            [['username'], 'unique'],
//            [['email'], 'unique'],
//            [['password_reset_token'], 'unique'],
        ];
    }

    /*
   * 定义执行的场景
   * zhaoyinfan
   * 2016-06-16
   */
    public function scenarios()
    {
        $scenarios = parent::scenarios();//本行必填，不写的话就会报unknown scenarios:default错误
        $scenarios[ 'admin-create'] = ['id', 'username', 'email', 'password', 'repassword','realname', 'phone','module','role', 'status', 'creater', 'created_at',  'updated_at', 'description', ];
        $scenarios[ 'admin-update'] =['id','username', 'email', 'password', 'repassword','realname', 'phone','module','role', 'status', 'creater', 'created_at', 'updated_at', 'description',];
        $scenarios[ 'admin-change-password'] = ['oldpassword', 'password', 'repassword'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户ID',
            'username' => '用户名',
            'password' => '密码',
            'repassword' => '确认密码',
            'oldpassword' => '旧密码',
            'realname' => '真实姓名',
            'phone' => '联系电话',
            'modules' => '所属模块',
            'shop_id' => '商家ID',
            'role' => '角色等级',
            'email' => 'Email',
            'description' => '备注',
            'auth_key' => '自动登录key',
            'password_hash' => '密码',
            'password_reset_token' => '重置密码token',
            'status' => '状态',
            'creater' => '操作员',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->id =uniqid().rand(1000,9999);
                $this->setPassword($this->password);
                $this->generateAuthKey();
//                $this->email ;
                $this->generatePasswordResetToken();
            }
            return true;
        }
        return false;
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateOldPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = self::findOne(Yii::$app->user->identity->id);
            if (!$user || !$user->validatePassword($this->oldpassword)) {
                $this->addError($attribute,'旧密码不正确');
            }
        }
    }
    public static function modules($key = null)
    {
        $arr = [
//            '1' => '通用',
//            '2' => 'e-shop',
            '3' => '餐饮模块',

        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function role($key = null)
    {
        $arr = [
            '1' => '超级管理员',
            '2' => '系统管理员',
            '3' => '商家',
            '4' => '会员',
            '10' => '一般用户',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function status($key = null)
    {
        $arr = [
            '10' => '可用',
            '1' => '禁用',
            '0' => '删除',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_user".
 *
 * @property string $openid
 * @property string $phone
 * @property string $realname
 * @property string $notic
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid'], 'required'],
            [['openid'], 'string', 'max' => 80],
            [['phone', 'realname', 'notic'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'openid' => 'Openid',
            'phone' => '手机号码',
            'realname' => '姓名',
            'notic' => '备注',
        ];
    }
    public static function newUser($openid,$realname,$phone,$notic){
        $u=User::findOne($openid);
        if(!$u){$u=new User();$u->openid=$openid;}
        $u->realname=$realname;
        $u->phone=$phone;
        $u->notic=$notic;
        if (!$a = $u->save()) {
            file_put_contents('user_error.txt', json_encode($u->getErrors()), FILE_APPEND);
        }
        return $a;
    }
}

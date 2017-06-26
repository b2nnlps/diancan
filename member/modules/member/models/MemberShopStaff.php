<?php

namespace member\modules\member\models;

use Yii;

/**
 * This is the model class for table "n_member_shop_staff".
 *
 * @property integer $id
 * @property string $openid
 * @property integer $shop_id
 * @property string $created_time
 */
class MemberShopStaff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_member_shop_staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid', 'shop_id', 'created_time'], 'required'],
            [['shop_id'], 'integer'],
            [['created_time'], 'safe'],
            [['openid'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => 'Openid',
            'shop_id' => 'Shop ID',
            'created_time' => 'Created Time',
        ];
    }
}

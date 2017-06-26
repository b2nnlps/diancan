<?php

namespace member\modules\member\models;

use Yii;

/**
 * This is the model class for table "n_member_bind".
 *
 * @property integer $id
 * @property string $openid
 * @property integer $card_id
 * @property integer $shop_id
 * @property integer $credit
 * @property integer $type
 * @property integer $balance
 * @property integer $status
 * @property string $code
 * @property string $phone
 * @property string $realname
 * @property string $begin_time
 * @property string $end_time
 * @property string $created_time
 */
class MemberBind extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_member_bind';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id','card_id', 'type', 'phone','balance', 'realname', 'begin_time', 'end_time', 'created_time'], 'required'],
            [['card_id', 'type','shop_id','balance','status','credit'], 'integer'],
            [['begin_time', 'end_time', 'created_time'], 'safe'],
            [['openid'], 'string', 'max' => 50],
            [['phone', 'realname'], 'string', 'max' => 20],
            [['pass'], 'string', 'max' => 4],
            [['code'], 'string', 'max' => 9],
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
            'shop_id' => '店面id',
            'card_id' => '卡包id',
            'code' => '卡编号',
            'type' => '卡类型',
            'phone' => '手机号码',
            'pass' => '密码',
            'balance' => '余额',
            'credit' => '积分',
            'realname' => '会员姓名',
            'status' => '状态',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'created_time' => '创建时间',
        ];
    }
}

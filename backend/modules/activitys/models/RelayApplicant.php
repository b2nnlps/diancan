<?php

namespace backend\modules\activitys\models;

use Yii;

/**
 * This is the model class for table "{{%relay_applicant}}".
 *
 * @property string $id
 * @property string $wechat_id
 * @property integer $activity_id
 * @property string $name
 * @property string $mobilephone
 * @property integer $point
 * @property string $datetime
 * @property string $declaration
 * @property string $imgurl
 * @property integer $status
 */
class RelayApplicant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%relay_applicant}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wechat_id'], 'required'],
            [['activity_id', 'point', 'status'], 'integer'],
            [['datetime'], 'safe'],
            [['imgurl'], 'string'],
            [['wechat_id', 'declaration'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['mobilephone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wechat_id' => '报名者Openid',
            'activity_id' => '活动ID',
            'name' => '姓名',
            'mobilephone' => '手机号码',
            'point' => '助力值',
            'datetime' => '报名时间',
            'declaration' => '参赛宣言',
            'imgurl' => '照片URL',
            'status' => '状态',
        ];
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '正常',
            '0' => '禁用'
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
	 public static function getName($openid,$activity_id)
    {
        $tmp = self::find()->where(['wechat_id'=>$openid,'activity_id'=>$activity_id])->one();
        return $tmp['name'];
    }
    
}

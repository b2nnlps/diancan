<?php

namespace member\modules\activitys\models;

use Yii;
use common\components\base\BaseActiveRecord;

/**
 * This is the model class for table "{{%relay_awards}}".
 *
 * @property integer $id
 * @property string $isn
 * @property integer $prize_id
 * @property string $prize_name
 * @property string $sponsor_name
 * @property string $prize_winner
 * @property string $name
 * @property string $phone
 * @property integer point
 * @property integer $status
 * @property string $win_time
 * @property string $get_time
 */
class RelayAwards extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%relay_awards}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prize_id', 'point', 'status'], 'integer'],
            [['win_time', 'get_time'], 'safe'],
            [['isn', 'prize_name', 'sponsor_name', 'prize_winner'], 'string', 'max' => 255],
            [['name', 'phone'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '获奖ID',
            'isn' => 'ISN序列号',
            'prize_id' => '奖品ID',
            'prize_name' => '奖品名称',
            'sponsor_name' => '赞助商',
            'prize_winner' => '获奖者',
            'name' => '姓名',
            'phone' => '联系电话',
            'point' => '当前助力值',
            'status' => '领奖状态',
            'win_time' => '获奖时间',
            'get_time' => '领取时间',
        ];
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '已领奖',
            '0' => '未领奖'
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

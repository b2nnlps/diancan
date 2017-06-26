<?php

namespace backend\modules\activitys\models;

use Yii;

/**
 * This is the model class for table "{{%relay_record}}".
 *
 * @property string $id
 * @property integer $activity_id
* @property integer $point
 * @property string $from_user
 * @property string $to_user
 * @property string $date
 */
class RelayRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%relay_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id','point'], 'integer'],
            [['date'], 'safe'],
            [['from_user', 'to_user'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '助力记录ID',
            'activity_id' => '活动ID',
            'from_user' => '助力来自',
            'to_user' => '助力给',
            'point' => '助力值',
            'date' => '助力日期',
        ];
    }
}

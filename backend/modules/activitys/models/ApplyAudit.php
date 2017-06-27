<?php

namespace backend\modules\activitys\models;

use common\components\base\BaseActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%apply_audit}}".
 *
 * @property string $id
 * @property string $uid
 * @property string $item
 * @property integer $sid
 * @property integer $aid
 * @property string $name
 * @property string $phone
 * @property string $wx_number
 * @property string $remark
 * @property integer $status
 * @property string $created_time
 * @property string $updated_time
 */
class ApplyAudit extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%apply_audit}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['sid', 'aid', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['uid', 'item', 'wx_number', 'remark'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => '申请人uid',
            'item' => '项目',
            'sid' => '商家ID',
            'aid' => '活动ID',
            'name' => '姓名',
            'phone' => '手机号码',
            'wx_number' => '微信号',
            'remark' => '备注',
            'status' => '状态',
            'created_time' => '报名时间',
            'updated_time' => '更新时间',
        ];
    }
    public static function status($key = null)
    {
        $arr = [
            '2' => '已通过',
            '1' => '待审核',
            '0' => '已取消'
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

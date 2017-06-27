<?php

namespace backend\modules\activitys\models;

use Yii;
use common\components\base\BaseActiveRecord;
/**
 * This is the model class for table "{{%apply_attend}}".
 *
 * @property string $id
 * @property string $uid
 * @property integer $sid
 * @property integer $aid
 * @property string $item
 * @property string $name
 * @property string $phone
 * @property integer $number
 * @property string $cost
 * @property string $remark
 * @property string $explain
 * @property integer $ispay
 * @property integer $status
 * @property string $created_time
 * @property string $updated_time
 */
class ApplyAttend extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%apply_attend}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['sid', 'aid','number', 'ispay', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['uid', 'item','remark', 'explain'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
            [['ispay','cost'],'default','value'=>0],
            ['status','default','value'=>1],
            [['cost', ], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => '报名者uid',
            'sid' => '商家ID',
            'aid' => '活动ID',
            'item' => '活动项目',
            'name' => '姓名',
            'phone' => '手机号码',
            'number'=>'数量',
            'cost' => '费用',
            'remark' => '备注',
            'explain' => '说明',
            'ispay' => '付款状态',
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
    public static function ispay($key = null)
    {
        $arr = [
            '1' => '已付款',
            '0' => '未付款'
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function item($key = null)
    {
        $arr = [
            '1' => '活动上篇',
            '2' => '活动下篇'
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

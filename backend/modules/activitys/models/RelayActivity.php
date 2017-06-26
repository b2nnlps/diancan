<?php

namespace backend\modules\activitys\models;

use Yii;
use common\components\base\BaseActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%relay_activity}}".
 *
 * @property string $id
 * @property string $title
 * @property integer $type
 * @property string $imgurl
 * @property string $start_time
 * @property string $end_time
 * @property string $merchant
 * @property integer $willnum
 * @property integer $visit
 * @property string $send_title
 * @property string $send_detail
 * @property string $content
 * @property integer $status
 * @property string $u_id
 * @property string $created_time
 * @property string $updated_time
 */
class RelayActivity extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%relay_activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'imgurl', 'start_time', 'end_time', 'merchant', 'send_title', 'send_detail', 'content'], 'required'],
            [['type', 'willnum', 'visit', 'status'], 'integer'],
            [['imgurl', 'content'], 'string'],
            [['start_time', 'end_time', 'created_time', 'updated_time'], 'safe'],
            [['title', 'merchant', 'send_title', 'send_detail', 'u_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '活动ID',
            'title' => '活动名称',
            'type' => '活动类型',
            'imgurl' => '图片URL',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'merchant' => '商家名称',
            'willnum' => '报名人数',
            'visit' => '浏览次数',
            'send_title' => '转发标题',
            'send_detail' => '转发简介',
            'content' => '内容详情',
            'status' => '状态',
            'u_id' => '录入者ID',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
        ];
    }

    public static function status($key = null)
    {
        $arr = [
            '1' => '发布',
            '0' => '保存暂不发布'
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    /**
     * 活动类型
     * @param type $key
     * @return type
     */
    public static function type($key = null)
    {
        $arr = [
            '1' => '每人只能投一次',
            '2' => '每人每天能投一次'
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    /**
     * 返回活动名称
     * @param type $id
     * @return type
     */
    public static function getTitle($id)
    {
        $tmp = self::findOne($id);
        return $tmp['title'];
    }
    /**
     * 返回给列表下拉查询
     * @return array
     * author Fox
     */
    public static function gettArrayitle()
    {
        $model =ArrayHelper::map(self::find()->all(), 'id', 'title');
        return $model;
    }
    
}

<?php

namespace backend\modules\activitys\models;

use Yii;
use common\components\base\BaseActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%apply_activity}}".
 *
 * @property string $id
 * @property string $title
 * @property integer $type
 * @property string $imgurl
 * @property string $start_time
 * @property string $end_time
 * @property string $address
 * @property string $mapmove
 * @property integer $supplier_id
 * @property string $merchant
 * @property string $initiator
 * @property string $phone
 * @property string $message
 * @property string $uid
 * @property string $hedimg
 * @property string $url
 * @property string $intro
 * @property integer $charge
 * @property integer $restrict
 * @property integer $willnum
 * @property integer $pv
 * @property string $send_title
 * @property string $send_detail
 * @property string $content
 * @property integer $status
 * @property string $u_id
 * @property string $created_time
 * @property string $updated_time
 */
class ApplyActivity extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%apply_activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'imgurl', 'start_time', 'end_time', 'address', 'merchant', 'initiator', 'phone', 'restrict', 'send_title', 'send_detail', 'content'], 'required'],
            [['type', 'supplier_id', 'charge', 'restrict', 'willnum', 'pv', 'status'], 'integer'],
            [['imgurl', 'content'], 'string'],
            [['start_time', 'end_time', 'created_time', 'updated_time'], 'safe'],
            [['charge'],'default','value'=>0],
            [['title', 'address', 'mapmove', 'merchant', 'initiator', 'phone', 'uid',  'hedimg','url', 'intro','message', 'send_title', 'send_detail', 'u_id'], 'string', 'max' => 255],
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
            'address' => '活动地址',
            'mapmove' => '地图坐标',
            'supplier_id' => '商家ID',
            'merchant' => '商家名称',
            'uid' => '发起人ID',
            'initiator' => '发起人',
            'phone' => '手机号码',
            'hedimg' => '头像',
            'intro' => '简介',
            'url' => 'URL',
            'message' => '消息推送',
            'charge' => '费用',
            'restrict' => '上限人数',
            'willnum' => '报名人数',
            'pv' => '浏览次数',
            'send_title' => '转发标题',
            'send_detail' => '转发简介',
            'content' => '内容详情',
            'status' => '状态',
            'u_id' => '录入者ID',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
        ];
    }
    public static function status($key = null){
        $arr = [
            '1' => '发布',
            '0' => '保存暂不发布'
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function type($key = null){
        $arr = [
            '1' => '商家',
            '2' => '个人'
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
    public static function getArrayitle()
    {
        $model =ArrayHelper::map(self::find()->all(), 'id', 'title');
        return $model;
    }
    
}

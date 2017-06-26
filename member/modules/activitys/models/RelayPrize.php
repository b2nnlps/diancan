<?php

namespace member\modules\activitys\models;

use Yii;
use common\components\base\BaseActiveRecord;
/**
 * This is the model class for table "{{%relay_prize}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property string $web_url
 * @property integer $number
 * @property integer $surplus
 * @property integer point
 * @property string $sponsor
 * @property string $contacts
 * @property string $phone
 * @property string $address
 * @property integer $status
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class RelayPrize extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%relay_prize}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sponsor', 'contacts', 'phone', 'address'], 'required'],
            [['number', 'surplus', 'point', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'img', 'web_url', 'sponsor', 'contacts', 'phone', 'address', 'created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '奖品ID',
            'name' => '奖品名称',
            'img' => '奖品图片',
            'web_url' => '站点地址',
            'number' => '数量',
            'surplus' => '剩余',
            'point' => '达标值',
            'sponsor' => '赞助商',
            'contacts' => '联系人',
            'phone' => '电话',
            'address' => '联系地址',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_by' => '更新人',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '可用',
            '0' => '禁用'
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

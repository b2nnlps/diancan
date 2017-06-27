<?php

namespace backend\modules\eshop\models;

use Yii;

/**
 * This is the model class for table "{{%eshop_depot}}".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $name
 * @property string $admin
 * @property string $phone
 * @property string $addres
 * @property string $message
 * @property integer $status
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Depot extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eshop_depot}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'admin'], 'required'],
            [['message',], 'string'],
            [['status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['user_id', 'name', 'admin', 'phone', 'addres', 'created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'name' => '库房名称',
            'admin' => '管理员',
            'phone' => '联系电话',
            'addres' => '地址',
            'message'=> '消息推送',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_by' => '修改人',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
        ];
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '可用',
            '2' => '禁用',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

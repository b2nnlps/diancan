<?php

namespace backend\modules\sys\models;

use common\components\base\BaseActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%sys_fb}}".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $cid
 * @property string $title
 * @property string $intro
 * @property string $img
 * @property string $name
 * @property string $phone
 * @property string $map
 * @property string $address
 * @property string $content
 * @property integer $pv
 * @property integer $status
 * @property string $uid
 * @property string $created_time
 * @property string $updated_time
 */
class SysFb extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_fb}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'cid', 'pv', 'status'], 'integer'],
            [['content'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['title', 'intro', 'img', 'name', 'phone', 'map', 'address', 'uid'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => '所属公司ID',
            'cid' => '分类ID',
            'title' => '标题',
            'intro' => '简介',
            'img' => '图片',
            'name' => '姓名',
            'phone' => '联系电话',
            'map' => 'MAP',
            'address' => '地址',
            'content' => '内容详情',
            'pv' => '访问量',
            'status' => '状态',
            'uid' => '创建人ID',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
}

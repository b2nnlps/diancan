<?php

namespace member\modules\member\models;

use Yii;

/**
 * This is the model class for table "n_member_shop".
 *
 * @property integer $id
 * @property integer $name
 * @property integer $class_id
 * @property string $address
 * @property string $gps
 * @property string $contact
 * @property string $created_time
 */
class MemberShop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_member_shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'class_id', 'address', 'gps', 'contact', 'created_time'], 'required'],
            [['name', 'class_id'], 'integer'],
            [['created_time'], 'safe'],
            [['address'], 'string', 'max' => 255],
            [['gps'], 'string', 'max' => 20],
            [['contact'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '店名',
            'class_id' => '分类',
            'address' => '地址',
            'gps' => '定位位置',
            'contact' => '联系人',
            'created_time' => '创建时间',
        ];
    }
}

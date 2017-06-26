<?php

namespace member\modules\sys\models;

use Yii;

/**
 * This is the model class for table "{{%sys_district}}".
 *
 * @property string $id
 * @property string $name
 * @property string $parent_id
 * @property string $type
 *
 * @property District $parent
 * @property District[] $districts
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_district}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['parent_id'], 'integer'],
            [['type'], 'string'],
            [['name'], 'string', 'max' => 40],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => District::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '地区名称',
            'parent_id' => '父级id',
            'type' => '地区类型',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(District::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['parent_id' => 'id']);
    }
}

<?php

namespace member\modules\member\models;

use Yii;

/**
 * This is the model class for table "n_member_record".
 *
 * @property integer $id
 * @property string $openid
 * @property integer $staff_id
 * @property integer $bind_id
 * @property integer $type
 * @property integer $cost
 * @property string $created_time
 */
class MemberRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_member_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['staff_id', 'bind_id', 'type', 'cost', 'created_time'], 'required'],
            [['staff_id', 'bind_id', 'type', 'cost'], 'integer'],
            [['created_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'staff_id' => 'Staff ID',
            'bind_id' => 'bind_id',
            'type' => 'Type',
            'cost' => 'Cost',
            'created_time' => 'Created Time',
        ];
    }
}

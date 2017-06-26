<?php

namespace member\modules\member\models;

use Yii;

/**
 * This is the model class for table "n_member_token".
 *
 * @property string $id
 * @property string $data
 * @property integer $type
 * @property integer $time
 */
class MemberToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_member_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'data', 'type', 'time'], 'required'],
            [['type', 'time'], 'integer'],
            [['id'], 'string', 'max' => 8],
            [['data'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => '内容',
            'type' => '类型',
            'time' => '过期时间',
        ];
    }
}

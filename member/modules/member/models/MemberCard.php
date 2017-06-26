<?php

namespace member\modules\member\models;

use Yii;

/**
 * This is the model class for table "n_member_card".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property string $title
 * @property string $background
 * @property string $description
 * @property string $img
 * @property integer $bonus
 * @property integer $max_bonus
 * @property string $created_time
 */
class MemberCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_member_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'title', 'background', 'description', 'img', 'bonus', 'max_bonus', 'created_time'], 'required'],
            [['shop_id', 'bonus', 'max_bonus'], 'integer'],
            [['description'], 'string'],
            [['created_time'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['background'], 'string', 'max' => 7],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => 'Shop ID',
            'title' => '会员卡名',
            'background' => '背景颜色',
            'description' => '详细描述',
            'img' => '会员卡图像',
            'bonus' => '消费1元赠多少积分',
            'max_bonus' => '单次消费最多积分',
            'created_time' => '创建时间',
        ];
    }
}

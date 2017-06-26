<?php

namespace member\modules\member\models;

use Yii;

/**
 * This is the model class for table "n_member_coupon".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property string $brand_name
 * @property string $title
 * @property string $sub_title
 * @property string $description
 * @property string $img
 * @property string $background
 * @property integer $quantity
 * @property integer $cost
 * @property integer $status
 * @property string $begin_time
 * @property string $end_time
 * @property string $created_time
 */
class MemberCoupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_member_coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'brand_name', 'title', 'sub_title', 'description', 'img', 'background', 'quantity', 'cost', 'status', 'get_limit', 'begin_time', 'end_time', 'created_time'], 'required'],
            [['shop_id', 'quantity', 'cost', 'status', 'get_limit'], 'integer'],
            [['description'], 'string'],
            [['begin_time', 'end_time', 'created_time'], 'safe'],
            [['brand_name', 'title', 'sub_title'], 'string', 'max' => 80],
            [['img'], 'string', 'max' => 255],
            [['background'], 'string', 'max' => 7],
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
            'brand_name' => '版面名',
            'title' => '卡券名',
            'sub_title' => '副标题',
            'description' => '详细描述',
            'img' => '图像',
            'background' => '背景颜色',
            'quantity' => '发放数量',
            'cost' => '领取所需积分',
            'status' => '状态',
            'get_limit' => '单人最多领取',
            'begin_time' => '开始使用时间',
            'end_time' => '结束使用时间',
            'created_time' => '创建时间',
        ];
    }
}

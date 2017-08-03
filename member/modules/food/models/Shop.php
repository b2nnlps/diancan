<?php

namespace member\modules\food\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "n_food_shop".
 *
 * @property integer $id
 * @property string $name
 * @property string $contact
 * @property string $address
 * @property string $device_id
 * @property string $img
 * @property string $created_time
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_time'], 'safe'],
            [['name','device_id'], 'string', 'max' => 60],
            [['contact', 'img','description'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 80],
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
            'contact' => '联系人',
            'address' => '地址',
            'description' => '商家简介',
            'img' => '店头像',
            'device_id' => '打印机编号',
            'created_time' => '创建时间',
        ];
    }

    public static function getShopName($shop_id)
    {
        $model = self::findOne($shop_id);
        $name = $model['name'];
        return $name ? $name : "暂无";
    }

    public static function getShopList()
    {
        $shopId = Yii::$app->user->identity->shop_id;
        $role = Yii::$app->user->identity->role;
        if ($role < 3) {
            $list = self::find()->all();
        } else {
            $list = self::find()->where(['id' => $shopId])->all();
        }
        $model = ArrayHelper::map($list, 'id', 'name');
        return $model;
    }
}

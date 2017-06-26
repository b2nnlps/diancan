<?php

namespace member\modules\food\models;

use Yii;
use member\modules\food\models\Classes;

/**
 * This is the model class for table "n_food_food".
 *
 * @property integer $id
 * @property string $name
 * @property string $img
 * @property double $price
 * @property integer $shop_id
 * @property integer $class_id
 * @property string $created_time
 * @property string $updated_time
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'n_food_food';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','img', 'price', 'shop_id','class_id','type'], 'required'],
            [['price'], 'number'],
            [['shop_id', 'class_id','status'], 'integer'],
            [['created_time', 'updated_time','description'], 'safe'],
            [['name'], 'string', 'max' => 80],
            [['type', 'head_img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '菜名',
            'img' => '图片',
            'price' => '价格',
            'type' => '款式',
            'description' => '详细描述',
            'shop_id' => '所属商店',
            'class_id' => '所属分类',
            'status' => '状态',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }
    public static function getCategory()
    {
        $cookies = Yii::$app->request->cookies;

        $category= Classes::findAll(['shop_id'=>$cookies->getValue('shop_id',1)]);
        return $category;
    }
}

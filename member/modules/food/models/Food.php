<?php

namespace member\modules\food\models;

use Yii;

/**
 * This is the model class for table "n_food_food".
 *
 * @property integer $id
 * @property string $name
 * @property string $img
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
            [['name', 'shop_id', 'class_id'], 'required'],
            [['shop_id', 'sort', 'class_id', 'status', 'is_attach'], 'integer'],
            [['created_time', 'updated_time','description'], 'safe'],
            [['name'], 'string', 'max' => 80],
            [['head_img'], 'string', 'max' => 255],
            [['img'], 'string'],
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
            'sort' => '自定义排序',
            'sold_number' => '已售',
            'description' => '详细描述',
            'shop_id' => '所属商店',
            'class_id' => '所属分类',
            'is_attach' => '是否是附加商品',
            'status' => '状态',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }

    public static function getFoodeName($id)
    {
        $model = self::findOne($id);
        $name = $model['name'];
        return $name ? $name : "暂无";
    }
    public static function status($key = null)
    {
        $arr = [
            '0' => '上架',
            '1' => '售完',
            '2' => '下架',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    public static function is_attach($key = null)
    {
        $arr = [
            '0' => '否',
            '1' => '是',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function getCategory()
    {
        $cookies = Yii::$app->request->cookies;

        $category= Classes::findAll(['shop_id'=>$cookies->getValue('shop_id',1)]);
        return $category;
    }
    public static function getFoodList($shop_id){
        $food = (new \yii\db\Query())
            ->select(['a.id', 'a.name as fname','head_img','b.img','c.price','b.name as cname','a.sold_number','a.status','c.id as iid','c.title','c.score','a.score_number'])
            ->from('n_food_food a')
            ->leftJoin('n_food_food_info c','a.id=c.food_id')
            ->rightJoin('n_food_classes b','a.class_id = b.id')
            ->where('a.shop_id=:shop_id AND (a.status=0 OR a.status=1)',[':shop_id'=>$shop_id])
            ->orderBy('class_id')
            ->all();
        return $food;
    }
    public static function getStock($food_id){//获取该商品所剩余的数量
        $num = FoodInfo::find()->where(['food_id' => $food_id, 'status' => 0])->sum('number');
        if(!$num)$num=0;
        return $num;
    }

    public static function getPrices($food_id)
    {//获取该商品的区间价格
        $low = 99999;
        $high = 0;
        $info = FoodInfo::find()->where(['food_id' => $food_id, 'status' => 0])->all();
        foreach ($info as $_info) {
            if ($high < $_info['price']) $high = $_info['price'];
            if ($low > $_info['price']) $low = $_info['price'];
        }
        if ($low == $high)
            return $low;
        else
            return $low . '-' . $high;
    }
    public static function getCart(){//获取购物车内容
        if(!isset($_COOKIE['cart']))  return false;

        $cookie=$_COOKIE['cart'];
        $cookie=json_decode($cookie,true);
        return $cookie['cart'];
    }
    public static function getCartNumber(){//获取购物车商品数量
        $cart=self::getCart();
        if(!$cart) return 0;
        $total=0;
        for($i=0;$i<count($cart);$i++){
            if($cart[$i]['num']>0) $total+=$cart[$i]['num'];
        }
        return $total;
    }

}

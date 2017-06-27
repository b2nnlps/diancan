<?php

namespace backend\modules\news\models;

use common\components\base\BaseActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%news_category}}".
 *
 * @property integer $id
 * @property integer $supplier_id
 * @property string $name
 * @property integer $pid
 * @property string $path
 * @property integer $status
 * @property string $uid
 * @property string $created_time
 * @property string $updated_time
 */
class NewsCategory extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'pid', 'status'], 'integer'],
            [['name'], 'required'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'path', 'uid'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supplier_id' => '商家ID',
            'name' => '分类名称',
            'pid' => '父ID',
            'path' => '路径',
            'status' => '状态',
            'uid' => '创建人ID',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }


    public static function getCategoryName($id)
    {
        $model = self::findOne($id);
        $name=$model['name'];
        return $name?$name:'顶级分类';
    }
    /**
     * 获取所有的分类
     */
    public function getCategories()
    {
        $data = self::find()->all();
        $data = ArrayHelper::toArray($data);
        return $data;
    }

    /**
     *遍历出各个子类 获得树状结构的数组
     */
    public static function getTree($data,$pid = 0,$lev = 1)
    {
        $tree = [];
        foreach($data as $value){
            if($value['pid'] == $pid){
                $value['name'] = str_repeat('|___',$lev).$value['name'];
                $tree[] = $value;
                $tree = array_merge($tree,self::getTree($data,$value['id'],$lev+1));
            }
        }
        return $tree;
    }

    /**
     * 得到相应  id  对应的  分类名  数组
     */
    public function getOptions()
    {
        $data = $this->getCategories();
        $tree = $this->getTree($data);
        $list = ['顶级分类'];
        foreach($tree as $value){
            $list[$value['id']] = $value['name'];
        }
        return $list;
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '可用',
            '2' => '禁用',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

<?php

namespace backend\modules\merchant\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%merchant_category}}".
 *
 * @property integer $id
 * @property integer $supplier_id
 * @property string $name
 * @property integer $parent_id
 * @property string $icon
 * @property string $brief
 * @property integer $is_nav
 * @property string $banner
 * @property string $keywords
 * @property string $description
 * @property string $redirect_url
 * @property integer $sort_order
 * @property integer $status
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Category extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'parent_id', 'is_nav', 'sort_order', 'status'], 'integer'],
            [['name'], 'required'],
            [['created_time', 'updated_time'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['icon', 'brief', 'banner', 'keywords', 'description', 'redirect_url', 'created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '类别ID',
            'supplier_id' => '商家ID',
            'name' => '名称',
            'parent_id' => '根节点',
            'icon' => '图标',
            'brief' => '简述',
            'is_nav' => '导航是否显示',
            'banner' => 'Banner图片',
            'keywords' => '关键字',
            'description' => '描述',
            'redirect_url' => '外部链接',
            'sort_order' => '排列次序',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_by' => '修改人',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }

    public static function is_nav($key = null)
    {
        $arr = [
            '1' => '显示',
            '2' => '不显示',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '可用',
            '2' => '禁用',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    /**
     * 返回给列表和视图界面
     * @param $pid
     * @return mixed
     * author Fox
     */
    public static function getParent($pid)
    {
        $model = self::findOne($pid);
        $pname=$model['name'];
        return $pname?$pname:"顶级";
    }
    /**
     * 返回给列表下拉查询
     * @return array
     * author Fox
     */
    public static function getparentCategory($cid="")
    {
        $parentCategory = ArrayHelper::merge([0 =>'顶级'], ArrayHelper::map(Category::get(0,Category::find()->asArray()->all()), 'id', 'label'));
        unset($parentCategory[$cid]);
        return $parentCategory;
    }
    /**
     * Get all catalog order by parent/child with the space before child label
     * Usage: ArrayHelper::map(Catalog::get(0, Catalog::find()->asArray()->all()), 'id', 'label')
     * @param int $parentId  parent catalog id
     * @param array $array  catalog array list
     * @param int $level  catalog level, will affect $repeat
     * @param int $add  times of $repeat
     * @param string $repeat  symbols or spaces to be added for sub catalog
     * @return array  catalog collections
     */
    static public function get($parentId = 0, $array = [], $level = 0, $add = 2, $repeat = '　')
    {
        $strRepeat = '';
        // add some spaces or symbols for non top level categories
        if ($level > 1) {
            for ($j = 0; $j < $level; $j++) {
                $strRepeat .= $repeat;
            }
        }

        $newArray = array ();
        //performance is not very good here
        foreach ((array)$array as $v) {
            if ($v['parent_id'] == $parentId) {
                $item = (array)$v;
                $item['label'] = $strRepeat . (isset($v['title']) ? $v['title'] : $v['name']);
                $newArray[] = $item;

                $tempArray = self::get($v['id'], $array, ($level + $add), $add, $repeat);
                if ($tempArray) {
                    $newArray = array_merge($newArray, $tempArray);
                }
            }
        }
        return $newArray;
    }
    
}

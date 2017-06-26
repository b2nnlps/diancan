<?php

namespace member\modules\sys\models;

use common\components\base\BaseActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%sys_link}}".
 *
 * @property integer $id
 * @property integer $c_id
 * @property string $title
 * @property string $img
 * @property string $url
 * @property integer $sort
 * @property integer $status
 * @property string $remark
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Link extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_link}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_id', 'sort', 'status'], 'integer'],
            [['img'], 'required'],
            ['sort', 'default', 'value' =>100],//设置默认值
            [['created_time', 'updated_time'], 'safe'],
            [['title', 'img', 'url', 'remark', 'created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'c_id' => '分类ID',
            'title' => '标题',
            'img' => '图片',
            'url' => 'URL地址',
            'sort' => '排序',
            'status' => '状态',
            'remark' => '备注',
            'created_by' => '创建人',
            'updated_by' => '更新人',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
    public static function category($key=null){
        $arr=[
            '1'=>'E-shop模块首页轮播',
            '2'=>'E-shop模块导航链接',
			'3'=>'助力活动头部广告切换',
        ];
        return $key===null?$arr:(isset($arr[$key])?$arr[$key]:'');
    }
    public static function status($key=null){
        $arr=[
            '1'=>'可用',
            '2'=>'禁用',
        ];
        return $key===null?$arr:(isset($arr[$key])?$arr[$key]:'');
    }

}

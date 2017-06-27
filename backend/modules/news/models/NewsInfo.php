<?php

namespace backend\modules\news\models;

use common\components\base\BaseActiveRecord;
use Yii;

/**
 * This is the model class for table "{{%news_info}}".
 *
 * @property integer $id
 * @property integer $supplier_id
 * @property integer $cid
 * @property string $title
 * @property string $intro
 * @property string $img
 * @property integer $carousel
 * @property string $source
 * @property string $source_url
 * @property string $editor
 * @property integer $hret_status
 * @property string $hret_url
 * @property string $content
 * @property integer $pv
 * @property integer $praise
 * @property integer $collect
 * @property integer $transpond
 * @property integer $status
 * @property string $uid
 * @property string $created_time
 * @property string $updated_time
 */
class NewsInfo extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'cid', 'carousel', 'hret_status', 'pv', 'praise', 'collect', 'transpond', 'status'], 'integer'],
            [['title', 'intro', 'source', 'source_url', 'editor', 'content'], 'required'],
            [['content'], 'string'],
            [['pv', 'praise', 'collect', 'transpond', 'status'], 'default', 'value' =>0],
            [['created_time', 'updated_time'], 'safe'],
            [['title', 'intro', 'img', 'source', 'source_url', 'editor', 'hret_url', 'uid'], 'string', 'max' => 255],
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
            'cid' => '分类ID',
            'title' => '标题',
            'intro' => '简介',
            'img' => '图片',
            'carousel' => '是否轮播',
            'source' => '来源',
            'source_url' => '来源网址',
            'editor' => '责任编辑',
            'hret_status' => '外链状态',
            'hret_url' => '外链地址',
            'content' => '内容详情',
            'pv' => '访问量',
            'praise' => '点赞量',
            'collect' => '收藏量',
            'transpond' => '转发量',
            'status' => '状态',
            'uid' => '创建人ID',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
    public static function carousel($key = null)
    {
        $arr = [
            '0' => '否',
            '1' => '是',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function hretStatus($key = null)
    {
        $arr = [
            '0' => '禁用',
            '1' => '使用',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '可用',
            '0' => '禁用',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }


}

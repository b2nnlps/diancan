<?php

namespace member\modules\sys\models;

use Yii;

/**
 * This is the model class for table "{{%sys_teletext}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $category_id
 * @property string $description
 * @property string $picurl

 * @property integer $whether
 * @property string $url
 * @property string $hret
 * @property string $content
 * @property integer $status
 */
class Teletext extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_teletext}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id', 'description'], 'required'],
            [['category_id', 'whether','hret', 'status'], 'integer'],
            [['content'], 'string'],
            [['title', 'description', 'picurl', 'url'], 'string', 'max' => 255],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '图文消息标题',
            'category_id' => '分类ID',
            'description' => '图文消息描述',
            'picurl' => '图片链接',
            'whether' => '是否大图显示最前',
            'url' => '图文消息跳转链接',
            'hret' => '是否显示外链',
            'content' => '内容详情',
            'status' => '状态',
        ];
    }
    public static function whether($key = null)
    {
        $arr = [
            '2' => '否',
            '1' => '是',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '发布',
            '0' => '暂不发布'
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function category($key = null)
    {
        $arr = [
            '1' => '关注公众号发送图文',
            '2' => 'e-shop二维码图文推送',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function hret($key = null)
    {
        $arr = [
            '2' => '否',
            '1' => '是',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
}

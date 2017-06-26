<?php

namespace backend\modules\eshop\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%eshop_sumpplier}}".
 *
 * @property integer $id
 * @property string $openid
 * @property string $user_id
 * @property string $name
 * @property string $logo
 * @property string $phone
 * @property string $address
 * @property string $ad_img
 * @property string $website
 * @property integer $views
 * @property string $labels
 * @property string $open_hours
 * @property string $open_scope
 * @property string $notice
 * @property string $message
 * @property string $content
 * @property integer $open
 * @property integer $status
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Sumpplier extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eshop_sumpplier}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'address','ad_img', 'labels', ], 'required'],
            [['message', 'content','ad_img', 'website', 'labels'], 'string'],
            [['open', 'status', 'views'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            ['views','default','value'=>0],
            [['openid', 'user_id', 'name', 'ad_img', 'website', 'labels','logo', 'phone', 'address', 'open_hours', 'open_scope', 'notice', 'created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => '用户Openid',
            'user_id' => '用户ID',
            'name' => '商家名称',
            'logo' => 'LOGO',
            'phone' => '电话',
            'address' => '地址',
            'website' => '站点',
            'ad_img' => '广告图',
            'labels' => '标签',
            'views' => '浏览次数',
            'open_hours' => '营业时间',
            'open_scope' => '营业范围',
            'notice' => '下单须知',
            'message' => '接收消息推送',
            'content' => '内容',
            'open' => '是否营业',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_by' => '修改人',
            'created_time' => '创建时间',
            'updated_time' => '修改时间',
        ];
    }
    public static function open($key = null)
    {
        $arr = [
            '1' => '营业中',
            '2' => '休息中',
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

    public static function getName($id)
    {
        $model = self::findOne($id);
        $pname=$model['name'];
        return $pname?$pname:"顶级";
    }
    /**
     * 返回给列表下拉查询
     * @return array
     * author Fox
     */
    public static function getSumpplier()
    {
        $model =ArrayHelper::map(self::find()->all(), 'id', 'name');
        return $model;
    }
    
}

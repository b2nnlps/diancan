<?php

namespace backend\modules\merchant\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%merchant_supplier}}".
 *
 * @property integer $id
 * @property string $rh_openid
 * @property string $name
 * @property integer $rank
 * @property string $website
 * @property string $ad_img
 * @property integer $pv
 * @property string $labels
 * @property string $logo
 * @property string $phone
 * @property string $address
 * @property string $map
 * @property string $open_hours
 * @property string $open_scope
 * @property string $notice
 * @property string $message
 * @property string $brief
 * @property string $content
 * @property integer $open
 * @property integer $status
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Supplier extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant_supplier}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'address'], 'required'],
            [['rank', 'pv', 'open', 'status'], 'integer'],
            [['message', 'content'], 'string'],
            [['created_time', 'updated_time'], 'safe'],
            [['rh_openid', 'name', 'website', 'ad_img', 'labels', 'logo', 'phone', 'address', 'map', 'open_hours', 'open_scope', 'notice', 'brief', 'created_by', 'updated_by'], 'string', 'max' => 255],
            [['pv',],'default','value'=>0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rh_openid' => '会员OpenId',
            'name' => '商家名称',
            'rank' => '级别',
            'website' => '站点',
            'ad_img' => '广告图',
            'pv' => '访问量',
            'labels' => '标签',
            'logo' => 'LOGO',
            'phone' => '电话',
            'address' => '地址',
            'map' => '地理位置',
            'open_hours' => '营业时间',
            'open_scope' => '营业范围',
            'notice' => '下单须知',
            'message' => '消息推送',
            'brief'=>'简述',
            'content' => '详情',
            'open' => '是否营业',
            'status' => '状态',
            'created_by' => '创建人',
            'updated_by' => '修改人',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }
    public static function rank($key = null)
    {
        $arr = [
            '1' => '供应商',
            '2' => '代理商',
            '3' => '会员',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
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
    public static function getSupplier()
    {
        $model =ArrayHelper::map(self::find()->all(), 'id', 'name');
        return $model;
    }
}

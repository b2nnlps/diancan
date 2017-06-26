<?php

namespace backend\modules\sys\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%sys_member}}".
 *
 * @property string $openid
 * @property string $realname
 * @property string $phone
 * @property string $referrer
 * @property string $ticket
 * @property integer $rank
 * @property string $headimgurl
 * @property string $nickname
 * @property string $sdasd
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $remark
 * @property integer $status
 * @property string $updated_by
 * @property string $created_time
 * @property string $updated_time
 */
class Member extends \common\components\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid', 'realname', 'phone'], 'required'],
            [['province', 'city', 'rank','district', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['openid', 'realname', 'phone', 'referrer', 'ticket', 'headimgurl', 'nickname', 'sdasd', 'address', 'remark', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'openid' => 'Openid',
            'realname' => '真实姓名',
            'phone' => '联系电话',
            'referrer' => '推荐人',
            'ticket' => '推广二维码',
            'rank' => '级别',
            'headimgurl' => '用户头像',
            'nickname' => '昵称',
            'sdasd' => '个性签名',
            'province' => '省',
            'city' => '市',
            'district' => '县/区',
            'address' => '详细地址',
            'remark' => '备注',
            'status' => '状态',
            'updated_by' => '更新人',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }

    public static function getMemberName($openid)
    {
        $model = self::findOne($openid);
        $name=$model['realname'];
        return $name?$name:'无';
    }
    public static function getMember()
    {
        $model =ArrayHelper::map(self::find()->asArray()->all(), 'openid', 'realname');
        return $model;
    }
    public static function getAgent()
    {
        $model =ArrayHelper::map(self::find()->where(['rank'=>1])->asArray()->all(), 'openid', 'realname');
        return $model;
    }
    public static function status($key=null){
        $arr=[
            '1'=>'可用',
            '2'=>'禁用',
        ];
        return $key===null?$arr:(isset($arr[$key])?$arr[$key]:'');
    }
    public static function rank($key = null)
    {
        $arr = [
            '1' => '普通会员',
            '2' => '代理',
            '3' => '股东',
            '0' => '总代理',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    /**
     * 返回给列表下拉查询
     * @return array
     * author Fox
     */
    public static function getrealname()
    {
        $model =ArrayHelper::map(self::find()->all(), 'openid', 'realname');
        return $model;
    }
    /**
     * 返回会员电话
     * @param $openid
     * @return $phone
     * author Fox
     */
    public static function getPhone($openid)
    {
        $model = self::findOne($openid);
        $phone=$model['phone'];
        return $phone;
    }
}

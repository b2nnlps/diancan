<?php

namespace backend\modules\merchant\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%merchant_member}}".
 *
 * @property integer $id
 * @property string $rh_openid
 * @property string $uid
 * @property string $wx_openid
 * @property string $realname
 * @property integer $rank
 * @property integer $sex
 * @property string $phone
 * @property string $hobby
 * @property string $referrer
 * @property string $ticket
 * @property string $ticket_url
 * @property string $headimg
 * @property string $nickname
 * @property string $sdasd
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $remark
 * @property integer $status
 * @property string $operator
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
        return '{{%merchant_member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['realname'], 'required'],
            [['rank', 'sex', 'province', 'city', 'district', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['rh_openid', 'uid', 'wx_openid','hobby', 'referrer', 'ticket', 'ticket_url', 'headimg', 'sdasd', 'address', 'remark', 'operator'], 'string', 'max' => 255],
            [['realname', 'nickname'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '会员ID',
            'rh_openid' => '会员OpenId',
            'uid' => 'UID',
            'wx_openid' => '微信OpenId',
            'realname' => '真实姓名',
            'rank' => '级别',
            'phone' => '联系电话',
            'sex' => '性别',
            'hobby' => '爱好',
            'referrer' => '推荐人',
            'ticket' => '推广二维码Ticket',
            'ticket_url' => '推广二维码URL',
            'headimg' => '用户头像',
            'nickname' => '昵称',
            'sdasd' => '个性签名',
            'province' => '省',
            'city' => '市',
            'district' => '县/区',
            'address' => '详细地址',
            'remark' => '备注',
            'status' => '状态',
            'operator' => '操作员',
            'created_time' => '创建时间',
            'updated_time' => '更新时间',
        ];
    }

    public static function getMemberName($rh_openid)
    {
        $model = self::find()->where(['rh_openid'=>$rh_openid])->one();
        $name=$model['realname'];
        return $name?$name:'无';
    }
    public static function getMember()
    {
        $model =ArrayHelper::map(self::find()->asArray()->all(), 'id', 'realname');
        return $model;
    }
    public static function getAgent()
    {
        $model =ArrayHelper::map(self::find()->where(['rank'=>1])->asArray()->all(), 'id', 'realname');
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
            '1' => '供应商',
            '2' => '代理商',
            '3' => '会员',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function sex($key = null)
    {
        $arr = [
            '1' => '男',
            '0' => '女',
            '10' => '保密',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    public static function hobby($key = null)
    {
        $arr = [
            '1' => '社交',
            '2' => '旅游',
            '3' => '美食',
            '4' => '娱乐',
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
        $model =ArrayHelper::map(self::find()->all(), 'id', 'realname');
        return $model;
    }
    /**
     * 返回会员电话
     * @param $openid
     * @return $phone
     * author Fox
     */
    public static function getPhone($rh_openid)
    {
        $model = self::find()->where(['rh_openid'=>$rh_openid])->one();
        $phone=$model['phone'];
        return $phone;
    }
    
}

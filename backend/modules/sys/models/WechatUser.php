<?php

namespace backend\modules\sys\models;

use Yii;

/**
 * This is the model class for table "{{%sys_wechat_user}}".
 *
 * @property string $openid
 * @property string $nickname
 * @property string $headimgurl
 * @property integer $sex
 * @property string $address
 * @property integer $subscribe
 * @property string $subscribe_time
 * @property string $updated_time
 * @property string $remark
 * @property string $wechat
 * @property integer $module
 * @property integer $auth_time
 * @property integer $status
 */
class WechatUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_wechat_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid'], 'required'],
            [['sex', 'subscribe', 'module', 'auth_time', 'status'], 'integer'],
            [['subscribe_time','updated_time'], 'safe'],
            [['openid', 'headimgurl', 'address', 'remark'], 'string', 'max' => 255],
            [['nickname','wechat'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'openid' => 'Openid',
            'nickname' => '用户昵称',
            'headimgurl' => '用户头像',
            'sex' => '性别',
            'address' => '省市区',
            'subscribe' => '是否订阅',
            'subscribe_time' => '关注时间',
            'remark' => '备注',
			'wechat' => '来自公众号',
            'module' => '模块ID',    
            'auth_time' => '第一次授权时间',
            'status' => '资料状态',
            'updated_time' => '更新时间',
        ];
    }
    /**
     * 返回用户头像
     * @param $openid
     * @return string
     * author Fox
     */
    public static function getHeadimgurl($openid)
    {
        $user= self::findOne($openid);
        $headimgurl=$user['headimgurl'];
        $file_url=Yii::$app->params['file_url'];
        $noHead=$file_url."/img/head.jpg";
        return $headimgurl?$headimgurl:$noHead;
    }
   /**
     * 用户类型更新
     * @param $openid
     */
    public static function getStatus($openid){
        $user= self::findOne($openid);
        if(!empty($user)){
            $user->status=1;
            $user->save();
        }
    }
    /**
     *  返回用户昵称
     * @param $openid
     * @return mixed|string
     * author Fox
     */
    public static function getNickname($openid)
    {
        $model= self::findOne($openid);
        $nickname=$model['nickname'];
        $name="昵称为空";
        return $nickname?$nickname:$name;
    }

    public static function sex($key = null)
    {
        $arr = [
            '0' => '未知',
            '1' => '男',
            '2' => '女',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function subscribe($key = null)
    {
        $arr = [
            '0' => '未关注',
            '1' => '已关注',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function usertype($key = null)
    {
        $arr = [
            '0' => '访客',
            '1' => '实名用户',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

  
    public static function module($key = null)
    {
        $arr = [
            '1' => '通用',
            '2' => 'e-shop',
			'3' => '助力活动',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

}

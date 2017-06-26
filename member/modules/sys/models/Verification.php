<?php

namespace member\modules\sys\models;

use Yii;

/**
 * This is the model class for table "{{%sys_verification}}".
 *
 * @property integer $id
 * @property string $c_uid
 * @property integer $code
 * @property string $phone
 * @property string $time
 * @property integer $click
 * @property integer $totalclick
 * @property integer $status
 * @property string $remarks
 */
class Verification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_verification}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'time'], 'required'],
            [['code', 'click','status', 'totalclick'], 'integer'],
            [['time'], 'safe'],
            [['c_uid', 'phone',  'remarks'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'c_uid' => '用户ID',
            'code' => '验证码',
            'phone' => '手机号码',
            'time' => '时间',
            'click' => '今日点击',
            'totalclick' => '总点击',
            'status' => '状态',
            'remarks' => '备注',
        ];
    }
    public static function status($key = null)
    {
        $arr = [
            '1' => '可用',
            '0' => '禁用',
        ];
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    public static function send($num,$mobile){
        $b=base64_encode($num);
        $a=base64_encode($mobile);
        $c=base64_encode('56c6bc03543af7070');//短信用户ID进行加密

        $date=date('Y-m-d').'LLRJronghe0898';
        $temp=md5($mobile.$num.'56c6bc03543af7070'.$date);
        $d=base64_encode($temp);//进行规则运算

//        $s="http://localhost/message/frontend/web/sms/sms-send?a=$a&b=$b&c=$c&d=$d";
        $s="http://message.n39.cn/sms/sms-send?a=$a&b=$b&c=$c&d=$d";

        return $text2 = file_get_contents($s);

    }
	
	
    public static function send_sms($mobile,$content){
        $uri='http://119.145.9.12/sendSMS.action';
        $enterpriseID = "16737";
        $loginName = "admin";
        $Pass= '6ac6c0e3d730d0fc2c3d55fe3b23b291';//strtolower(md5($password));
        $data = array (
            'enterpriseID' =>$enterpriseID,
            'loginName'=>$loginName,
            'password'=>$Pass,
            'smsId'=>'',
            'subPort'=>'',
            'mobiles'=>$mobile,
            'content'=>$content
        );
        $ch = curl_init ();
        curl_setopt
        ( $ch, CURLOPT_URL, $uri );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        $return = curl_exec ( $ch );
        curl_close ( $ch );
        return $return;
    }
	
}

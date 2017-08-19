<?php

namespace frontend\controllers;

use backend\modules\sys\models\Teletext;
use common\models\User;
use Yii;
use common\wechat\Wechat;
use member\modules\food\models\Shop;
use yii\web\Controller;
/**
 * Class WechatController
 * @package frontend\controllers
 * 美食俱乐部公众号控制器
 */




class WechatMsjlbApiController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        try {
            $params = Yii::$app->params['wechat_msjlb'];
            // file_put_contents('txt.txt','params=='.$params."",FILE_APPEND);
            $wechat = new Wechat($params);
        //  $wechat->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
            $type = $wechat->getRev()->getRevType();
            switch ($type) {
                case Wechat::MSGTYPE_TEXT:
                    $kw = $wechat->getRev()->getRevContent();
                    switch ($kw) {
                        case 'cj' :
                            $data= array (
                                'button' => array (
                                    0 => array (
                                        'name' => '美食官方',
                                        'sub_button' => array (
                                            0 => array (
                                                'type' => 'view',
                                                'name' => '最新动态',
                                                'url' => 'http://mp.weixin.qq.com/mp/homepage?__biz=MzA3NTc1NzM5OQ==&hid=1&sn=d45bf00f0e7d3905f8898bf6914aac18&uin=MjI5ODI2OTg2MQ%3D%3D&key=c3acc508db720376d6cbca6d5f7813f4b38abff3145557000d3611adabefe34e2eb4e4cd3a120f18f486327b6760ed99&devicetype=android-23&version=26031b31&lang=zh_CN&nettype=WIFI&wx_header=1&scene=1',
											//  'url' => 'http://micro.n39.cn/microsite?uid=df2c82c41a0bf173542deb691cb66099',
                                            ),
                                        ),
                                    ),
                                    1 => array (
                                        'name' => '容合商行',
                                        'type' => 'view',
                                        'url' => 'http://ms.n39.cn/eshop/good/index',
                                    ),
                                    2 => array (
                                        'name' => '系统帮助',
                                        'sub_button' => array(
                                            0 => array(
                                                'type' => 'view',
                                                'name' => '点餐演示',
                                                'url' => 'http://ms.n39.cn/food/user/index?shopId=1',
                                            ),
                                            1 => array(
                                                'type' => 'view',
                                                'name' => '休闲娱乐',
                                                'url' => 'http://jj.5jy.cn',
                                            ),
                                            2 => array(
                                                'type' => 'view',
                                                'name' => '容合社区',
                                                'url' => 'http://vzan.cc/f/s-18785',
                                            ),
                                            3 => array(
                                                'type' => 'view',
                                                'name' => '堂内点餐',
                                                'url' => 'http://ms.n39.cn/food/user/index?shopId=2',
                                            ),
                                        ),
                                    ),
                                ),
                            );
                            $text = json_encode($wechat->createMenu($data));
                            break;
                        case '客服' :
                            $text = $this->replyText();
                            break;
                        default :
                            $text='';
                            if($text=='') {
                              // $text = $this->defaultText();
                                $wechat->transfer_customer_service('shejianshn@163.com')->reply();//消息转接到多客服
                            }
                            break;
                    }
                    $wechat->text($text)->reply();
                    break;
                case Wechat::MSGTYPE_EVENT:
                    $event =$wechat->getRev()->getRevEvent();
                    $scene =$wechat->getRevSceneId();//获取到二维码场景值
                    if ($event ['event'] == 'subscribe') {
                        $this->Teletext($scene,$wechat);
                    }elseif($event ['event'] == 'SCAN') {
                           $this->Teletext($scene,$wechat);
//                        $text = "您好，欢迎来到美食俱乐部！。\n";
//                        $text .= "您之前已关注过该公众号！^_^^_^，场景值为：".$scene;
//                        $wechat->text($text)->reply();
                    }elseif ($event ['event'] == 'unsubscribe') {
                        // 取消订阅
                        $text = '';
                    }elseif ($event ['key'] == '3000') { //开发提示0
                        $text = $this->tsText();
                    }
                    $wechat->text($text)->reply();
                    break;
                default:
                    $wechat->text($this->defaultText())->reply();
            }
        } catch (\Exception $e) {
            $info = $e->getMessage();
            file_put_contents('txt.txt','Exception==='.$info."",FILE_APPEND);
        }
    }
    protected function Teletext($scene,$wechat)
    {
        /**
         * 关注后弹出的图文信息
         */
        if($scene!=null){//如果通过带场景值的二维码扫描关注
            $openid =$wechat->getRevFrom();//获取微信消息发送者OpenID
            $pieces = explode(",", $scene); 
            $modules=$pieces[0];//所属模块ID  
            $sceneId=$pieces[1];//场景值的OpenId 
            if($modules=='eshop'){
                $newsData = array();
                $model=Teletext::find()->where(['and',['status'=>1],['category_id'=>2]])->one();
                $newsData[] = array(
                    "Title" =>$model['title'],
                    "Description" =>$model['description'],
                    "PicUrl" =>$model['picurl'],
                    'Url'=>'http://ms.n39.cn/eshop/personal/add?openid='.$openid.'&sceneid='.$sceneId
                );
                 return $wechat->news($newsData)->reply();
            } elseif ($modules == 'food') {
                $shop = Shop::findOne($pieces[1]);
                $newsData[0] = array(
                    'Title' => "欢迎光临【$shop[name]】",
                    'Description' => "您的桌号是$pieces[2]，点我点餐.\n" . $shop['description'],
                    'PicUrl' => $shop['img'],
                    'Url' => "http://ms.n39.cn/food/user/index?shopId=" . $pieces[1] . "&table=" . $pieces[2]
                );
                return $wechat->news($newsData)->reply();
            } else {
                $text = "获取到的模块ID为：" . $modules . "场景值为：" . $sceneId;
                $wechat->text($text)->reply();
            }
        }else{
            /**
             * 关注后弹出图文消息
             */
            $newsData=array();//图文消息个数，限制为10条以内
            $model=Teletext::find()->where(['and',['status'=>1],['category_id'=>1]])->limit(6)->orderBy('whether asc')->all();
            for($i=0;$i<count($model);$i++){
                $_v=$model[$i];
                $newsData[$i]=array(
                    'Title'=>$_v['title'],
                    'Description'=>$_v['description'],
                    'PicUrl'=>$_v['picurl'],
                    'Url'=>$_v['url']
                );
            }
            return $wechat->news($newsData)->reply();
        }
    }


    protected function tsText()
    {
        $text = "正在开发中！";
        return $text;
    }

    protected function replyText()
    {
        $text = "您好，欢迎关注美食俱乐部！\n";
        $text .= "美食俱乐部欢迎您！^_^^_^，客服电话：0998-62922223";
        return $text;
    }

    protected function defaultText()
    {
        $text = "您好，我是美食俱乐部，很高兴为您服务，有任何疑问欢迎留言^_^\n";
        return $text;
    }




}

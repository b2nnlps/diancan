<?php

namespace frontend\modules\merchant\controllers;

use backend\modules\merchant\models\Address;
use backend\modules\merchant\models\Agent;
use backend\modules\merchant\models\Product;
use backend\modules\merchant\models\Supplier;
use backend\modules\sys\models\WechatUser;
use common\models\ComModel;
use common\wechat\PushMessage;
use Yii;
use backend\modules\merchant\models\Member;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\controllers\BaseController;
/**
 * Default controller for the `merchant` module
 */
class UserController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
     public function actionIndex(){
        $wx_openid=$this->wx_openid;//操作人
        if (($model =Member::find()->where(['wx_openid'=>$wx_openid])->one()) !== null) {
            $rh_openid=$this->rh_openid;
            $wx_openid=$model['wx_openid'];
            $rank=$model['rank'];
            return $this->render('index',[
                'model'=>$model,
                'rh_openid'=>$rh_openid,
                'wx_openid'=>$wx_openid,
                'rank'=>$rank,
            ]);
        } else {
            return $this->redirect('add');
        }
    }

    /**
     * 收货地址
     * @return string
     */
    public function actionAddress(){
        $request = Yii::$app->request;
        $sid= $request->get('sid');
        if($sid){$sid=$sid;}else{$sid=0;}
        $rh_openid=$this->rh_openid;
        $model=Address::find()->where(['rh_openid'=>$rh_openid])->all();
        return $this->render('address',[
            'model'=>$model,
            'sid'=>$sid,
        ]);
      
    }
      /**
     * 新增地址
     * @return string
     */
    public function actionAddRegion(){
        $wx_openid=$this->wx_openid;//操作人
        if (($model =Member::find()->where(['wx_openid'=>$wx_openid])->one()) !== null) {
            return $this->render('add-region',[]);
        } else {
            return $this->redirect('add');
        }
    }


    /**
     * 更新地址信息
     * @param $id
     * @return string
     */
    public function actionUpdateRegion($id){
        $model=$this->findAddress($id);
        return $this->render('update-region',[
            'model'=>$model,
        ]);
    }


    /**
     * 个人资料
     * @return string
     */
    public function actionDetails($rh_openid){
        $model = $this->findMember($rh_openid);
        return $this->render('details',[
            'model'=>$model,
        ]);
    }
     /**
     * 用户详情
     * @return string
     */
    public function actionUserInfo($rh_openid){
        $wx_openid=$this->wx_openid;
        $openId="oV1VUt6RUheAI-xfveukXdNW2ak8,";
        $mess_push=explode(',',$openId);
        $mess=array_unique($mess_push);
        //in_array(value,array,type)
        $isin = in_array($wx_openid,$mess);//php判断数组元素中是否存在某个字符串的方法
        if($isin){
            $inArray=1;//存在
        }else{
            $inArray=10;//不存在
        }
        $model = $this->findMember($rh_openid);
        return $this->render('user-info',[
            'model'=>$model,
            'rh_openid'=>$rh_openid,
            'inArray'=>$inArray,
        ]);
    }
    /**
     * 注册会员
     * @return string
     */
    public function actionAdd(){
        $wx_openid=$this->wx_openid;
        if (($model =Member::find()->where(['wx_openid'=>$wx_openid])->one()) !== null) {
            return $this->redirect('index');
        } else {
            return $this->render('add',[
                'wx_openid'=>$wx_openid,
            ]);
        }


    }
    public function actionUpdate($rh_openid){
        $model = $this->findMember($rh_openid);
        $wx_openid=$model['wx_openid'];
        return $this->render('update',[
            'model'=>$model,
            'rh_openid'=>$rh_openid,
            'wx_openid'=>$wx_openid,
        ]);
    }
    public function actionUserList(){
        $model=Member::find()->where(['status'=>1])->all();
        return $this->render('user-list',[
            'model'=>$model,
        ]);
    }
  public function actionGeneralize(){
        $rh_openid=$this->rh_openid;
//        $wx_openid=$this->wx_openid;
        $supplier=Supplier::find()->where(['rh_openid'=>$rh_openid])->one();
        $supplierID=$supplier['id'];
        $agent=Agent::find()->where(['supplier_id'=>$supplierID])->all();
        $member=Member::find()->where(['rh_openid'=>$rh_openid])->one();
        $wx_openid=$member['wx_openid'];
        $rank=$member['rank'];
        return $this->render('generalize',[
            'wx_openid'=>$wx_openid,
            'agent'=>$agent,
            'supplier'=>$supplier,
            'supplierID'=>$supplierID,
            'rank'=>$rank,
        ]);
    }
    /**
     * 商品管理列表
     * @param $sump_id
     * @return string
     */
    public function actionProductGl(){
        $rh_openid=$this->rh_openid;
//        $wx_openid=$this->wx_openid;
        $supplier=Supplier::find()->where(['rh_openid'=>$rh_openid])->one();
        $supplierID=$supplier['id'];
        $agent=Agent::find()->where(['supplier_id'=>$supplierID])->all();
        return $this->render('product-gl',[
            'agent'=>$agent,
        ]);
    }
    /**
     * 商品修改
     * @param $sump_id
     * @return string
     */
    public function actionProductUpdate($aid){
        $model=Agent::findOne($aid);
        $product_id=$model['product_id'];
        $product=Product::findOne($product_id);
        return $this->render('product-update',[
            'model'=>$model,
            'product'=>$product,
        ]);
    }
    public function actionWdgl($sid){
        $model=Supplier::findOne($sid);
        if(!empty($model)){
            return $this->render('wdgl',[
                'model'=>$model,
            ]);
        }else{
            throw new NotFoundHttpException('所请求信息不存在！');
        }
    }
    public function actionWdinfoSave(){
        $request = Yii::$app->request;
        $sid= $request->post('sid');
        $name= $request->post('name');
        $address= $request->post('address');
        $phone= $request->post('phone');
        $open_hours=$request->post('open_hours');
        $brief=$request->post('brief');
        $notice=$request->post('notice');
        $originator=$request->post('originator');
        $supplier=Supplier::findOne($sid);
        if(!empty($supplier)){
            if (!session_id()) session_start();//如果session_id 不存在,说明没有储存, 打开session，否则。
            if($originator == $_SESSION['rep_wdgl']) {
                $supplier->name=$name;
                $supplier->phone=$phone;
                $supplier->address=$address;
                $supplier->open_hours=$open_hours;
                $supplier->brief=$brief;
                $supplier->notice=$notice;
                $supplier->save();

                $strResult= '';
            }else{
                $strResult= '请不要刷新本页面或重复提交表单!';
            }
        }else{
            $strResult= '没有该商家信息!';
        }

        return $strResult;
    }

    protected function findMember($rh_openid){
        if (($model =Member::find()->where(['rh_openid'=>$rh_openid])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('所请求信息不存在！');
        }
    }
    protected function findAddress($id){
        if (($model =Address::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('所请求信息不存在！');
        }
    }
    public function actionInfoSave(){
        $request = Yii::$app->request;
        $rank= $request->post('rank');
        $remark= $request->post('remark');
        $originator=$request->post('originator');
        $rh_openid=$request->post('rh_openid');
        $operator=$this->rh_openid;
        $wx_openid=$this->wx_openid;
        $member =Member::find()->where(['rh_openid'=>$rh_openid])->one();
        if(!empty($member)){
            if (!session_id()) session_start();//如果session_id 不存在,说明没有储存, 打开session，否则。
            if($originator == $_SESSION['rep_uinfo']) {
                $member->rank=$rank;
                $member->remark=$remark;
                $member->operator=$operator;
                if($member->save()){
                    if($rank==1||$rank==2){
                        $supplier=Supplier::find()->where(['rh_openid'=>$rh_openid])->one();
                        if(empty($supplier)){

                            $realname=$member['realname'];
                            $phone=$member['phone'];
                            $dqwx_openid=$member['wx_openid'];

                            $supplier=new Supplier();
                            $supplier->rh_openid=$rh_openid;
                            $supplier->logo=WechatUser::getHeadimgurl($dqwx_openid);
                            $supplier->name=$realname.'的微店';
                            $supplier->phone=$phone;
                            $supplier->address=$member['address'];
                            $supplier->message=$dqwx_openid;


                            $open_id=$wx_openid.','.$dqwx_openid.",oV1VUt6RUheAI-xfveukXdNW2ak8";
                            $mess_push=explode(',',$open_id);
                            $mess=array_unique($mess_push);
//                            $gourl="http://ms.n39.cn/merchant/user/details?rh_openid=".$rh_openid;
                            $gourl=Yii::$app->urlManager->createAbsoluteUrl(['merchant/user/user-info','rh_openid'=>$rh_openid]);
                            $ranks=Supplier::rank($rank);
                            $subtitle='恭喜'.$realname.'成功升级为'.$ranks.'.';
                            $account=$realname.'【'.$phone.'】';
                            $time=date("Y.m.d H:i:s");
                            $type='升级';
                            $remark="如有任何问题请电话联系：0898-62922223,谢谢！";
                            for($i=0;$i<count($mess);$i++){
                                if(isset($mess[$i])){
                                    if($mess[$i]!=''){
                                        PushMessage::AccountMessage($mess[$i],$gourl,$subtitle,$account,$time,$type,$remark);
                                    }}
                            }


                        }
                        $supplier->rank=$rank;

                        $supplier->save();

                    }
                }

                $strResult='';
                unset($_SESSION["rep_uinfo"]);//将其清除掉此时再按F5则无效
            }else{
                $strResult= '请不要刷新本页面或重复提交表单!';
            }
        }else{
            $strResult= '找不到所请求信息!';
        }
        return $strResult;
    }
    public function actionProductSave(){
        $request = Yii::$app->request;
        $agentID=$request->post('agentID');
        $stock= $request->post('stock');
        $bookable= $request->post('bookable');
        $price=$request->post('price');
        $status= $request->post('status');
        $remark= $request->post('remark');
        $originator=$request->post('originator');
        if (!session_id()) session_start();//如果session_id 不存在,说明没有储存, 打开session，否则。
        if($originator == $_SESSION['rep_sqgx']) {
            $agent=Agent::findOne($agentID);
            $agent->stock=$stock;
            $agent->bookable=$bookable;
            $agent->price=$price;
            $agent->status=$status;
            $agent->remark=$remark;
            $agent->save();
            $strResult='';
            unset($_SESSION["rep_uinfo"]);//将其清除掉此时再按F5则无效
        }else{
            $strResult= '请不要刷新本页面或重复提交表单!';
        }
        return $strResult;
    }
    /**
     * 用户注册信息保存
     * @return string
     * author Fox
     */
    public function actionRegister(){
        $request = Yii::$app->request;
//        $a = $request->post('a'); //不存在则返回null
//        $a = $request->post('a', 2); //如果$a不存在需要提供个默认值
        $realname= $request->post('realname');
        $phone= $request->post('phone');
        $address= $request->post('address');
        $sex= $request->post('sex');
        $remark= $request->post('remark');
        $sub_rand=$request->post('sub_rand');
        if($realname!=''&&$phone!=''&&$address!=''){

            $yz=Yii::$app->session['zc_resubmit'];//获取session值
            if($yz==$sub_rand){//判断是否重复提交
                $strResult='error:2';
            }else{
                echo Yii::$app->session['zc_resubmit']=$sub_rand;//赋值给session

                $rh_openid=$this->rh_openid;
                $wx_openid=$this->wx_openid;
                $member =Member::find()->where(['rh_openid'=>$rh_openid])->one();
                if(empty($member)){
                    $member=new Member();
                    $member->rh_openid='FXSC-'.ComModel::createRandomStr(28);//随机生成字符串
                    $member->rank=3;//会员
                    $member->status=1;//可用
                    $member->wx_openid=$wx_openid;
                    $member->remark=$remark;
                }
                $member->realname=$realname;
                $member->phone=$phone;
                $member->sex=$sex;
                $member->address=$address;
                $type= $request->post('type');
                if($type!='update'){
                   if($member->save()){
                        $rh_openid1=$member->rh_openid;
                        $addressModel=new Address();
                        $addressModel->rh_openid=$rh_openid1;
                        $addressModel->consignee=$realname;
                        $addressModel->phone=$phone;
                        $addressModel->address=$address;
                        $addressModel->default=10;
                        $addressModel->status=1;
                        $addressModel->operator=$rh_openid1;
                        $addressModel->save();


                        $open_id=$wx_openid.",oV1VUt6RUheAI-xfveukXdNW2ak8";
                        $mess_push=explode(',',$open_id);
                        $mess=array_unique($mess_push);
                        $gourl="http://ms.n39.cn/merchant/user/user-info?rh_openid=".$rh_openid1;
                        $subtitle='您好!'.$realname.'已成功注册成为会员。';
                        $time=date("Y.m.d H:i:s");
                        $remark="如有任何问题请电话联系：0898-62922223,谢谢！";
                        for($i=0;$i<count($mess);$i++){
                            if(isset($mess[$i])){
                                if($mess[$i]!=''){
                                    PushMessage::zctxMessage($mess[$i],$gourl,$subtitle,$realname,$phone,$time,$remark);
                                }}
                        }

                    }
                }else{
                    $sdasd= $request->post('sdasd');
                    $hobby= $request->post('hobby');
                    $member->sdasd=$sdasd;
                    $member->hobby=$hobby;
                    $member->save();


                }
                $strResult='';
            }
        }  else {
            $strResult='error:1';
        }
        return $strResult;
    }
    /**
     * 保存地址信息
     */
    public function actionSaveRegion(){
        $rh_openid=$this->rh_openid;
//        $wx_openid=$this->wx_openid;

        $request = Yii::$app->request;
        $consignee= $request->post('consignee');
        $phone= $request->post('phone');
        $defaults=$request->post('defaults');
//        $provinvce= $request->post('provinvce');
//        $city=$request->post('city');
//        $district=$request->post('district');
        $address=$request->post('address');
        $zipcode = $request->post('zipcode');

        if ($consignee && $phone && $defaults  && $address) {
            if (!session_id()) session_start();//如果session_id 不存在,说明没有储存, 打开session，否则。
            $originator=$request->post('originator');
            if($originator == $_SESSION['rep_verify']) {

                $id =$request->post('id');
                if($id){
                    $model=Address::findOne($id);
                }else{
                    $model=new Address();
                }
                $model->rh_openid=$rh_openid;
                $model->consignee=$consignee;
                $model->phone=$phone;
//            $model->provinvce=$provinvce;
//            $model->city=$city;
//            $model->district=$district;
                $model->address=$address;
                $model->zipcode=$zipcode;
                $model->default=$defaults;
                $model->status=1;
                if($model->save()){
                    if($model->default==10){
                        $addressModel=Address::find()->where(['and',['rh_openid'=>$rh_openid],['!=','id',$model->id],['default'=>10]])->all();
                        foreach ($addressModel as $_v){
                            $_v->default=1;
                            $_v->save();
                        }
                    }
                }
                $strResult='';
                unset($_SESSION["rep_verify"]);//将其清除掉此时再按F5则无效
            }else{
                $strResult= '请不要刷新本页面或重复提交表单!';
            }

        }else {
            $strResult='相关参数值不能为空！';
        }

        return $strResult;
    }

}

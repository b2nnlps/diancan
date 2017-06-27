<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-16
 * Time: 16:50
 */
use backend\modules\activitys\models\ApplyAttend;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>容合活动吧</title>
    <?= \yii\helpers\Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/style.css" rel="stylesheet" type="text/css">
    <link href="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/styles/fontico.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="box">
    <div class="Favorites">
        <ul class="clearfix">
            <li><a href="javascript:history.go(-1)"><img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/return.png" width="20" height="20"></a></li>
            <p>报名审核</p>
            <li></li>
        </ul>
    </div>
    <div class="particularsbox">
        <dl class="clearfix">
            <dt>姓 名：</dt>
            <dd><?=$applyAttend['name']?></dd>
        </dl>
        <dl class="clearfix">
            <dt>手 机：</dt>
            <dd><?=$applyAttend['phone']?></dd>
        </dl>
        <dl class="clearfix">
            <dt>人 数：</dt>
            <dd><?=$applyAttend['number']?>人</dd>
        </dl>
<!--        <dl class="clearfix">-->
<!--            <dt>活 动：</dt>-->
<!--            <dd>-->
<!--                --><?php
//                $item= $applyAttend['item'];
//                $item_arry=explode(",", $item);
//                foreach ($item_arry as $_v){
//                    echo $item_name=ApplyAttend::item($_v[0]).' , ';
//                } ?>
<!--            </dd>-->
<!--        </dl>-->

        <dl class="clearfix">
            <dt>时 间：</dt>
            <dd><?=$applyAttend['created_time']?></dd>
        </dl>
        <dl class="clearfix">
            <dt>备 注：</dt>
            <dd><?=$applyAttend['remark']?></dd>
        </dl>
        <?php
        $status=$applyAttend['status'];
        $ispay=$applyAttend['ispay'];
        if($status==1){?>
            <dl class="clearfix">
                <dt>费 用：</dt>
                <dd><input type="text" id="cost" value="<?=$applyAttend['cost']?>"></dd>
            </dl>
            <dl class="clearfix">
                <dt>付 款：</dt>
                <dd>
                    <ul>
                        <li><input type="radio" id="radio-2-2" name="radio" class="regular-radio big-radio" value="0"<?php if($ispay==0){echo $ispay_checked='checked';}?>/>
                            <label for="radio-2-2"></label><span><label for="radio-2-2">未支付</label></span>
                        </li>
                        <li><input type="radio" id="radio-2-1" name="radio" class="regular-radio big-radio" value="1"  <?php if($ispay==1){echo $ispay_checked='checked';}?>/>
                            <label for="radio-2-1"></label><span><label for="radio-2-1">已支付</label></span>
                        </li>
                    </ul>
                </dd>
            </dl>
            <dl class="clearfix">
                <dt>状 态：</dt>
                <dd><select id="status">
                        <option value="2" <?php if($status==2){echo $status_selected='selected';}?>>已通过</option>
                        <option value="1" <?php if($status==1){echo $status_selected='selected';}?>>待审核</option>
                        <option value="0" <?php if($status==0){echo $status_selected='selected';}?>>已取消</option>
                    </select></dd>
            </dl>
            <dl style="border:none;" class="clearfix">
                <dt>说 明：</dt>
                <dd><textarea id="explain"><?=$applyAttend['explain']?></textarea></dd>
            </dl>
        <?php }else{?>
            <dl class="clearfix">
                <dt>已 付：</dt>
                <dd><?=$applyAttend['cost']?>元</dd>
            </dl>
            <dl class="clearfix">
                <dt>付 款：</dt>
                <dd><?=ApplyAttend::ispay($applyAttend['ispay'])?></dd>
            </dl>
            <dl class="clearfix">
                <dt>状 态：</dt>
                <dd><?=ApplyAttend::status($status)?></dd>
            </dl>
            <dl class="clearfix">
                <dt>说 明：</dt>
                <dd><?=$applyAttend['explain']?></dd>
            </dl>
        <?php } ?>

    </div>
    <div class="footer"><a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['activitys/default/about']) ?>">容合<img src="<?=Yii::$app->view->theme->baseUrl?>/hdb_v1.0/icon/logo.png" width="20" height="20"/>活动吧</a></div>
    <?php if($status==1){?>
        <div class="submitBtn" >提 交</div>
    <?php }?>


</div>
</body>
</html>
<script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/hDialog/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?=Yii::$app->view->theme->baseUrl?>/relay_v1/js/jquery.hDialog.js"></script>

<script>
    /**
     * 返回顶部，报名窗口，助力点赞提示
     * @returns {undefined}
     */
    $(function(){
        var checkSubmitFlg = false;
        $('.submitBtn').click(function() {//提交报名并验证表单
            if (!checkSubmitFlg) {
                var csrfName = $('meta[name=csrf-param]').prop('content');
                var crsfToken = $('meta[name=csrf-token]').prop('content');
                var bm_id =<?=$applyAttend['id']?>;
                var cost = $('#cost');
                var radios = document.getElementsByName("radio"); //获得 单选选按钮name集合
                for(var i=0;i<radios.length;i++) //根据 name集合长度 遍历name集合
                {
                    if(radios[i].checked)//判断那个单选按钮为选中状态
                    {
                        ispay=radios[i].value;//弹出选中单选按钮的值
                    }
                }
                status=document.getElementById("status").value;
                var explain = $('#explain');

                if(cost.val() === ''){
                    $.tooltip('已交费用还没填呢，免费则填0...'); cost.focus();
                }else if(isNaN(cost.val())){
                    $.tooltip('费用必须为整数或小数...'); cost.focus();
                }else{
                    var data =csrfName + '='+crsfToken+"&id="+bm_id+"&cost="+cost.val()+"&ispay="+ispay+"&status="+status+"&explain="+explain.val();
                    //alert(data);
                    if (!checkSubmitFlg) {
                        checkSubmitFlg = true;// 第一次提交
                        $.post("<?=\yii\helpers\Url::to(['apply/updatesave'])?>", data, function (result) {
                            if(result!==''){
                                $.dialog( 'alert','温馨提示', result, 4000,true);
                            }else{
                                window.location.href="<?=Yii::$app->urlManager->createAbsoluteUrl(['activitys/apply/update','id'=>$applyAttend['id']])?>";
                            }
                        });

                    }
                }
                return true;
            } else {
                //重复提交
                $.tooltip('请勿重复提交！');
                return false;
            }

        });
    });
</script>
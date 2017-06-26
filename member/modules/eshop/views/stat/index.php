<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-01-11
 * Time: 19:02
 */
use member\modules\eshop\models\Order;
use member\modules\eshop\models\Orderstatus;
use member\modules\sys\models\Member;
use member\modules\eshop\models\Orderproduct;
use member\modules\eshop\models\Product;
use member\modules\eshop\models\Sumpplier;
use yii\helpers\Html;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>订单统计表</title>
    <?=Html::csrfMetaTags()?>
    <link href="<?=Yii::$app->request->baseUrl?>/stat//style/base.css" rel="stylesheet" type="text/css"/>

    <script src="<?=Yii::$app->request->baseUrl?>/stat/script/jquery-1.8.2.min.js"></script>
    <script src="<?=Yii::$app->request->baseUrl?>/stat/script/index.js"></script>
    <script src="<?=Yii::$app->request->baseUrl?>/laydate-v1.1/laydate/laydate.js"></script>

</head>

<body>
<div class="wrapper">
    <!--头部：开始-->
    <div class="headline"><h1>订单统计表</h1><hr/></div>
    <form action="/eshop/stat" method="post">
        <div class="headBox">
            <ul class="clearfix">
                <li>
                    <label for="meeting">下单人：</label>
                    <select name="user_id">
                        <option value="">请选择</option>
                        <?php
                        $member=Member::find()->where(['!=','rank',1])->all();
                        foreach ($member as $_v){
                            ?>
                            <option value="<?=$_v['openid']?>"><?=$_v['realname']?></option>
                        <?php } ?>
                    </select>
                </li>
                <li>
                    <label for="meeting">代理商品：</label>
                    <select name="product_id">
                        <option value="">请选择</option>
                        <?php
                        $product=Product::find()->all();
                        foreach ($product as $_v){
                            ?>
                            <option value="<?=$_v['id']?>"><?=$_v['name']?></option>
                        <?php } ?>
                    </select>
                </li>

                <li>
                    <label for="meeting">下单时间：</label>
                    <input class="laydate-icon" id="start" name="start" />
                    —
                    <input class="laydate-icon" id="end" name="end" />
                </li>
                <!--            <li>-->
                <!--                <input type="text" placeholder="请您输入">-->
                <!--            </li>-->

                <li>
                    <label for="meeting">订单状态：</label>
                    <select name="status">
                        <option value="">请选择</option>
                        <?php
                        $product=Order::status();
                        foreach ($product as $_k=>$_v){
                            ?>
                            <option value="<?=$_k?>"><?=$_v?></option>
                        <?php } ?>
                    </select>
                </li>

                <li><input class="send" type="submit"></li>
            </ul>
        </div>

    </form>

    <!--头部：结束-->
    <!--主体内容：开始-->
    <!---->
    <div style="background-color:#E8F5FB" class="accordion-container">
        <!---->
        <div class="container">
            <div class="accordion">
                    <table class="colourbox">
                        <tr>

                            <th style="width:5%">序号</th>
                            <th style="width:15%">订单号</th>
                            <th style="width:5%">推介人</th>
                            <th style="width:5%">下单人</th>
                            <th style="width:5%">收件人</th>
                            <th style="width:10%">手机号码</th>
                            <th style="width:5%">总额</th>
                            <th style=" width:5%">支付方式</th>
                            <th style=" width:10%">支付状态</th>
                            <th style=" width:5%">状态</th>
                            <th style=" width:10%">是否结算</th>
                            <th style=" width:20%">下单时间</th>
                        </tr>
                    </table>
            </div>
        </div>

        <?php
            $numbers = 0;
            $total_amount=0;
            foreach ($order as $_k=>$_v){
                if($_k%2==1){$bc='#F9F9F9';}else{$bc='#ECF0F5';}
        ?>
        <div style="background-color:<?=$bc?>" class="container">
            <div class="accordion acist">
                    <table class="list">
                        <tr>
                            <th style="width:5%"><?=$_k+1?></th>
                            <th style="width:15%"><?=$_v['sn']?></th>
                            <th style="width:5%"><?=Member::getMemberName($_v['referrer'])?></th>
                            <th style="width:5%"><?=Member::getMemberName($_v['user_id'])?></th>
                            <th style="width:5%"><?=$_v['consignee']?></th>
                            <th style="width:10%"><?=$_v['phone']?></th>
                            <th style="width:5%"><?=$_v['amount']?></th>
                            <th style=" width:5%"><?=Order::method($_v['payment_method'])?></th>
                            <th style=" width:10%"><?=Order::payment_status($_v['payment_status'])?></th>
                            <th style=" width:5%"><?=Order::status($_v['status'])?></th>
                            <th style=" width:10%"><?=Order::clearing($_v['clearing'])?></th>
                            <th style=" width:20%"><?=$_v['created_time']?></th>
                        </tr>
                    </table>
            </div>
            <div class="accordion-desc">
                <table>
                    <tr class="colour">
                        <th style="">商品名称</th>
                        <th style=" ">商家</th>
                        <th style="">数量</th>
                        <th style=" ">单位</th>
                        <th style="">单价</th>
                        <th style=" ">总额</th>
                    </tr>

                    <tr class="colourchange">
                        <th style=""><?=Product::getProductName($_v['product_id'])?></th>
                        <th style=""><?=Sumpplier::getName($_v['supplier_id'])?></th>
                        <th style=""><?=$_v['number']?></th>
                        <th style=" "><?=$_v['sku']?></th>
                        <th style=""><?=$_v['price']?></th>
                        <th style=" "><?=$_v['amount']?></th>
                    </tr>


                </table>
            </div>
        </div>
        <?php
                $number =$_v['number'];
                $numbers += $number;
                $amount =$_v['amount'];
                $total_amount += $amount;
            }
        ?>
        <!-- end of container -->
    </div>
    <div class="totalbox">
        <span>总数量：<?=$numbers?></span>
        <span>总金额:<?=$total_amount?></span>
    </div>

    <!-- end of accordion-container -->
    <!---->
    <!--主体内容：结束-->
    <!--分页器：开始-->
    <!--分页器：结束-->
<!--    <ul class="pagination">-->
<!--        <li><a href="#">上一页</a></li>-->
<!--        <li><a href="#">1</a></li>-->
<!--        <li class="active"><span>2</span></li>-->
<!--        <li><a href="#">3</a></li>-->
<!--        <li><a href="#">4</a></li>-->
<!--        <li><a href="#">5</a></li>-->
<!--        <li><a href="#">6</a></li>-->
<!--        <li class="disabled"><span>下一页</span></li>-->
<!--    </ul>-->
    <!--分页器：结束-->
</div>

<script>
    var start = {
        elem: '#start',
        format: 'YYYY/MM/DD hh:mm:ss',
        min: laydate.now()-365, //设定最小日期为当前日期
        max: '2099-06-16 23:59:59', //最大日期
        istime: true,
        istoday: false,
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    var end = {
        elem: '#end',
        format: 'YYYY/MM/DD hh:mm:ss',
        min: laydate.now(),
        max: '2099-06-16 23:59:59',
        istime: true,
        istoday: false,
        choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };
    laydate(start);
    laydate(end);
</script>

</body>
</html>


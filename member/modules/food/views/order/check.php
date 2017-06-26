<?php
use member\modules\food\models\Food;

/* @var $this yii\web\View */
/* @var $searchModel member\modules\food\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '报表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <a class="btn btn-success"  onclick="tu('<?=date("Y-m-d",0)?>','<?=date("Y-m-d",time()+86400)?>')">全部</a>
    <a class="btn btn-success"  onclick="tu('<?=date("Y-m-d",time()-86400*30)?>','<?=date("Y-m-d",time()+86400)?>')">近一个月</a>
    <a class="btn btn-success"  onclick="tu('<?=date("Y-m-d",time()-86400*15)?>','<?=date("Y-m-d",time()+86400)?>')">近十五天</a>
    <a class="btn btn-success"  onclick="tu('<?=date("Y-m-d",time()-86400*7)?>','<?=date("Y-m-d",time()+86400)?>')">近七天</a>

    <table>
        <tr><td>#</td><td>菜品名称</td><td>销售数量</td>
    <?php
        $i=0;
        foreach($food as $_food){
            $i++;
            $f=Food::findOne($_food['food_id']);
            echo "<tr><td>$i.</td><td>$f[name]</td><td>x$_food[num]</td></tr>";
        }
    ?>
</table>
    <script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
<script src="/layer/layer.js"></script>
<script>
    function tu(begin,end){
        layer.open({
            type: 2,
            title: '营业额',
            fix: false,
            maxmin: true,
            shadeClose: true,
            area: ['1100px', '600px'],
            content: "/food/order/tu?begin="+begin+"&end="+end,
            end: function(){
                layer.tips('Hi', '#about', {tips: 1})
            }
        });


    }
    </script>
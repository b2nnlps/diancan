<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>营业额</title>

		<script type="text/javascript" src="http://cdn.hcharts.cn/jquery/jquery-1.8.2.min.js"></script>
        <?php
        $day_total=0;
        $month_total=0;
            foreach($o as $_o){ //统计数据
               $now=date("Y-m-d", strtotime($_o['updated_time']));
                $date[$now]['total']+=$_o['total'];
                $month_total+=$_o['total'];
            }

        $dates='';
        $totals='';
        foreach($date as $_date){
            $dates.="'$_date[date]',";
            //$totals.=round($_date['total']/100,2).',';
            $totals.=$_date['total'].',';
        }
        ?>

		<script type="text/javascript">
$(function () {
        $('#container2').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: '近 <?=$day?> 日订单记录'
            },
            subtitle: {
                text: '来源: 容合'
            },
            xAxis: {
                categories: [<?=$dates?> ]

            },
            yAxis: {
                title: {
                    text: '当天营业额'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [ {
                name: '营业额',
                data: [<?=$totals?>]
            }]
        });
    });
    

		</script>
	</head>
	<body>
<script src="/js/highcharts.js"></script>
<script src="/js/modules/exporting.js"></script>

总收入 <?= $month_total ?> 元
<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</body>
</html>

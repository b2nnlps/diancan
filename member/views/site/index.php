<?php

$this->title ='控制面板';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Content Header (Page header) -->
<!--<section class="content-header">-->
<!--    <h1>-->
<!--        控制面板-->
<!--        <small>控制台</small>-->
<!--    </h1>-->
<!--    <ol class="breadcrumb">-->
<!--        <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>-->
<!--        <li class="active">控制面板</li>-->
<!--    </ol>-->
<!--</section>-->

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
					<h3>3</h3>
                    <p>商品订单</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
               <a target="_blank" href="#" class="small-box-footer">订单统计 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>6<sup style="font-size: 20px"></sup></h3>
                    <p>商品信息</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">更多<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>966</h3>
                    <p>实名用户</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>889</h3>
                    <p>微信用户</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <div class="col-xs-12">


            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">新订单</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>订单号</th>
                            <th>总额</th>
                            <th>状态</th>
                            <th>用户名</th>
                            <th>收件人</th>
                            <th>手机号码</th>
                            <th>收货地址</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td><a href="">2017152347</a></td>
                            <td>555.88</td>
                            <td><span class="label label-warning">待支付</span></td>
                            <td>张三</td>
                            <td>李四</td>
						    <td>1800555555</td>
                            <td>海南琼海</td>
                        </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="">2017152347</a></td>
                                <td>555.88</td>
                                <td><span class="label label-primary">配送中</span></td>
                                <td>张三</td>
                                <td>李四</td>
                                <td>1800555555</td>
                                <td>海南琼海</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="">2017152347</a></td>
                                <td>555.88</td>
                                <td><span class="label label-info">已下单</span></td>
                                <td>张三</td>
                                <td>李四</td>
                                <td>1800555555</td>
                                <td>海南琼海</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="">2017152347</a></td>
                                <td>555.88</td>
                                <td><span class="label label-success">已成交</span></td>
                                <td>张三</td>
                                <td>李四</td>
                                <td>1800555555</td>
                                <td>海南琼海</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a href="">2017152347</a></td>
                                <td>555.88</td>
                                <td><span class="label label-danger">已取消</span></td>
                                <td>张三</td>
                                <td>李四</td>
                                <td>1800555555</td>
                                <td>海南琼海</td>
                            </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">登录统计</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>&nbsp;</th>
                            <th>今天</th>
                            <th>昨天</th>
                            <th>本周</th>
                            <th>上周</th>
                            <th>本月</th>
                            <th>上月</th>
                            <th>今年</th>
                            <th>去年</th>
                        </tr>
                        <tr>
                            <td>次数</td>
                            <td><?= $dataUser['todayCount'] ?></td>
                            <td><?= $dataUser['yesterdayCount'] ?></td>
                            <td><?= $dataUser['thisWeekCount'] ?></td>
                            <td><?= $dataUser['lastWeekCount'] ?></td>
                            <td><?= $dataUser['thisMonthCount'] ?></td>
                            <td><?= $dataUser['lastMonthCount'] ?></td>
                            <td><?= $dataUser['thisYearCount'] ?></td>
                            <td><?= $dataUser['lastYearCount'] ?></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">登录详情</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>登录用户</th>
                            <th>登录时间</th>
                           <!-- <th>登录地点</th>-->
                            <th>登录IP</th>
                        </tr>
                        <?php foreach ($login_log as $_v ):?>
                            <tr data-key="1">
                                <td><?=\common\models\User::getUser($_v['u_id'])?></td>
                                <td><?=date("Y-m-d H:i:s",$_v['login_time']);?></td>
                              <!--  <td><?=$_v['login_address']?></td>-->
                                <td><?=$_v['login_ip']?></td>
                            </tr>
                        <?php endforeach;?>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row (main row) -->

<!--</section>-->
<!-- /.content -->    <!-- /.content -->
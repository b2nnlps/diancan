<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-07-18
 * Time: 17:00
 */
$this->title ='Timeline-时间轴';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Timeline
        <small>example</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">UI</a></li>
        <li class="active">Timeline</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-red">
                  <?=date('Y-m-d',time())?>
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 19:30</span>

                        <h3 class="timeline-header"><a href="#">CEO</a>  发送Email</h3>

                        <div class="timeline-body">
                            今天下午公司召开关于七月份总结及8月份计划相关的例会，请全体人员务必参加。...
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs">阅读更多</a>
                            <a class="btn btn-danger btn-xs">删除</a>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 5 秒前</span>

                        <h3 class="timeline-header no-border"><a href="#">CTO</a>接受了你的好友请求</h3>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i>27 分钟前</span>

                        <h3 class="timeline-header"><a href="#">小张</a> 评论你的文章</h3>

                        <div class="timeline-body">
                            文章见解独到，值得分享！
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-warning btn-flat btn-xs"> 文章见解独到，值得分享！</a>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline time label -->
                <li class="time-label">
                  <span class="bg-green">
                     <?=date('Y-m-d',time()-360000)?>
                  </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 2 天前</span>

                        <h3 class="timeline-header"><a href="#">COO</a> 上传了新相片</h3>

                        <div class="timeline-body">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-video-camera bg-maroon"></i>

                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 5 天前</span>

                        <h3 class="timeline-header"><a href="#">CTO</a> 分享了一个Yii2视频教程</h3>

                        <div class="timeline-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="#" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="timeline-footer">
                            <a href="#" class="btn btn-xs bg-maroon">查看评论</a>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-code"></i> Timeline Markup</h3>
                </div>
                <div class="box-body">
                  <pre style="font-weight: 600;">
&lt;ul class="timeline">

    &lt;!-- timeline time label -->
    &lt;li class="time-label">
        &lt;span class="bg-red">
            10 Feb. 2014
        &lt;/span>
    &lt;/li>
    &lt;!-- /.timeline-label -->

    &lt;!-- timeline item -->
    &lt;li>
        &lt;!-- timeline icon -->
        &lt;i class="fa fa-envelope bg-blue">&lt;/i>
        &lt;div class="timeline-item">
            &lt;span class="time">&lt;i class="fa fa-clock-o">&lt;/i> 12:05&lt;/span>

            &lt;h3 class="timeline-header">&lt;a href="#">Support Team&lt;/a> ...&lt;/h3>

            &lt;div class="timeline-body">
                ...
                Content goes here
            &lt;/div>

            &lt;div class="timeline-footer">
                &lt;a class="btn btn-primary btn-xs">...&lt;/a>
            &lt;/div>
        &lt;/div>
    &lt;/li>
    &lt;!-- END timeline item -->

    ...

&lt;/ul>
                  </pre>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->

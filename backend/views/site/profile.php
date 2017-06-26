<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
$this->title =Yii::$app->user->identity->username.'-个人资料';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Content Header (Page header) -->
<!--    <section class="content-header">-->
<!--        <h1>-->
<!--            用户个人资料-->
<!--        </h1>-->
<!--        <ol class="breadcrumb">-->
<!--            <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>-->
<!--            <li><a href="#">例子</a></li>-->
<!--            <li class="active">个人资料</li>-->
<!--        </ol>-->
<!--    </section>-->

<!-- Main content -->
<!--    <section class="content">-->

<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?= $directoryAsset ?>/img/user2-160x160.jpg" alt="User profile picture">

                <h3 class="profile-username text-center"><?=Yii::$app->user->identity->username?></h3>

                <p class="text-muted text-center">软件工程师</p>
                <p class="text-muted text-center">Software Engineer</p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>粉丝</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                        <b>好友</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                        <b>博文</b> <a class="pull-right">13,28</a>
                    </li>
                </ul>
                <a href="#" class="btn btn-primary btn-block"><b>关注</b></a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">关于我-About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> 毕业院校</strong>
                <p class="text-muted">
                    海南软件学院
                </p>
                <hr>
                <strong><i class="fa fa-map-marker margin-r-5"></i> 工作地</strong>
                <p class="text-muted">海南省琼海市</p>
                <hr>
                <strong><i class="fa fa-pencil margin-r-5"></i> 基本技能-Skills</strong>
                <p>
                    <span class="label label-danger">UI Design</span>
                    <span class="label label-success">Coding</span>
                    <span class="label label-info">Javascript</span>
                    <span class="label label-warning">PHP</span>
                    <span class="label label-primary">Yii2</span>
                </p>
                <hr>
                <strong><i class="fa fa-file-text-o margin-r-5"></i> 个人简介</strong>
                <p>逐梦互联网+时代</p>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab">活动</a></li>
                <li><a href="#timeline" data-toggle="tab">时间轴</a></li>
                <li><a href="#settings" data-toggle="tab">设置</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="<?= $directoryAsset ?>/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">CEO</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                            <span class="description">公开于 - 7:30 PM 今天</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            今天下午公司召开关于七月份总结及8月份计划相关的例会，请全体人员务必参加。
                        </p>
                        <ul class="list-inline">
                            <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> 分享</a></li>
                            <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> 赞</a>
                            </li>
                            <li class="pull-right">
                                <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> 评论(5)</a></li>
                        </ul>
                        <input class="form-control input-sm" type="text" placeholder="评论">
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="<?= $directoryAsset ?>/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">CTO</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                            <span class="description">发送于 - 3 天前</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                            技术部全体成员今天下午召开部门例会，探讨**项目实施方案。
                        </p>
                        <form class="form-horizontal">
                            <div class="form-group margin-bottom-none">
                                <div class="col-sm-9">
                                    <input class="form-control input-sm" placeholder="回复">
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">发送</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post">
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="<?= $directoryAsset ?>/img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">COO</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                            <span class="description">上传于 - 5 天前</span>
                        </div>
                        <!-- /.user-block -->
                        <div class="row margin-bottom">
                            <div class="col-sm-6">
                                <img class="img-responsive" src="<?= $directoryAsset ?>/img/photo1.png" alt="Photo">
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <img class="img-responsive" src="<?= $directoryAsset ?>/img/photo2.png" alt="Photo">
                                        <br>
                                        <img class="img-responsive" src="<?= $directoryAsset ?>/img/photo3.jpg" alt="Photo">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <img class="img-responsive" src="<?= $directoryAsset ?>/img/photo4.jpg" alt="Photo">
                                        <br>
                                        <img class="img-responsive" src="<?= $directoryAsset ?>/img/photo1.png" alt="Photo">
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <ul class="list-inline">
                            <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> 分享</a></li>
                            <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> 赞</a>
                            </li>
                            <li class="pull-right">
                                <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> 评论(5)</a></li>
                        </ul>

                        <input class="form-control input-sm" type="text" placeholder="评论">
                    </div>
                    <!-- /.post -->
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
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
                                <h3 class="timeline-header"><a href="#">CEO</a> 发送Email</h3>
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
                                <h3 class="timeline-header no-border"><a href="#">CTO</a> 接受了你的好友请求
                                </h3>
                            </div>
                        </li>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-comments bg-yellow"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 27 分钟前</span>
                                <h3 class="timeline-header"><a href="#">小张</a> 评论你的文章</h3>
                                <div class="timeline-body">
                                    文章见解独到，值得分享！
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-warning btn-flat btn-xs">查看评论</a>
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
                                <span class="time"><i class="fa fa-clock-o"></i> 15:50</span>
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
                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">昵称</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputName" placeholder="昵称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">姓名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" placeholder="姓名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputExperience" class="col-sm-2 control-label">工作经验</label>

                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputExperience" placeholder="工作经验"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSkills" class="col-sm-2 control-label">掌握技能</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputSkills" placeholder="技能">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">我同意 <a href="#">服务条款和协议</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!--    </section>-->
<!-- /.content -->
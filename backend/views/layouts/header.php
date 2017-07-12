<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <!-- Logo -->
    <a href="<?=Yii::$app->homeUrl?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><?=Yii::$app->setting->get('siteName');?></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?=Yii::$app->setting->get('siteName');?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">切换导航</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">你有4个信息</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                                 alt="User Image"/>
                                        </div>
                                        <h4>
                                            测试工程师
                                            <small><i class="fa fa-clock-o"></i> 5分钟前</small>
                                        </h4>
                                        <p>这是一个很棒的主题。</p>
                                    </a>
                                </li>
                                <!-- end message -->
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/user3-128x128.jpg" class="img-circle"
                                                 alt="user image"/>
                                        </div>
                                        <h4>
                                           容合设计组
                                            <small><i class="fa fa-clock-o"></i> 2 小时前</small>
                                        </h4>
                                        <p>还需要设计几套新的主题吗?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/user4-128x128.jpg" class="img-circle"
                                                 alt="user image"/>
                                        </div>
                                        <h4>
                                            开发者
                                            <small><i class="fa fa-clock-o"></i> 1 天前</small>
                                        </h4>
                                        <p>这个主题很适合开发者。</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/user3-128x128.jpg" class="img-circle"
                                                 alt="user image"/>
                                        </div>
                                        <h4>
                                            业务部
                                            <small><i class="fa fa-clock-o"></i> 1 年前</small>
                                        </h4>
                                        <p>这个主题很适合推广。</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/user4-128x128.jpg" class="img-circle"
                                                 alt="user image"/>
                                        </div>
                                        <h4>
                                            评论者
                                            <small><i class="fa fa-clock-o"></i> 2 天前</small>
                                        </h4>
                                        <p>这个主题用户体验很好。</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">查看所有消息</a></li>
                    </ul>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">你有10个通知</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 今天新成员加入
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> 这可能有很长描述
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> 新用户加入
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> 系统定时更新
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i>您修改了新密码
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">你有9个任务</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            设计一些按钮
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">20% 完成</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            设计一个漂亮的主题
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">40% 完成</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            我需要做一些任务
                                            <small class="pull-right">60%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 60%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">60% 完成</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            做一个高大上的切换效果
                                            <small class="pull-right">80%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">80% 完成</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">查看所有任务</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?=Yii::$app->user->identity->username?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                            <p>
                                <?=Yii::$app->user->identity->username?> - <?=\backend\modules\sys\models\User::role(Yii::$app->user->identity->role)?>
                                <small><?=date('Y年m月d日',Yii::$app->user->identity->created_at)?>加入</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">粉丝（1,322）</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">好友（543）</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">博文（13,28）</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['site/change-password'])?>" class="btn btn-default bg-olive btn-flat">改密</a>
                            </div>
                          
                            <div class="pull-right">
                                <?= Html::a(
                                    '注销',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default bg-maroon btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

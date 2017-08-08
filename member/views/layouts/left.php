<aside class="main-sidebar">

    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p> <a href="#" ><?=Yii::$app->user->identity->username?> </a></p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => '控制面板', 'icon' => 'fa fa-dashboard',  'url' => ['/site/index'],'visible'=>Yii::$app->user->can('/site/index')],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

//                    [
//                        'label' => '餐饮系统',
//                        'icon' => 'fa fa-hourglass-end',
//                        'url' => '/food/food/index',
//                        'items' => [

                            ['label' => '菜品管理', 'icon' => 'fa fa-cubes', 'url' => ['/food/food/index'], 'visible' => Yii::$app->user->can('/food/food/index')],
                            ['label' => '菜品分类', 'icon' => 'fa fa-server', 'url' => ['/food/classes/index'], 'visible' => Yii::$app->user->can('/food/classes/index')],
                            ['label' => '店家信息', 'icon' => 'fa fa-institution', 'url' => ['/food/shop/index'], 'visible' => Yii::$app->user->can('/food/shop/index')],

                            ['label' => '员工信息', 'icon' => 'fa fa-users', 'url' => ['/food/shop-staff/index'], 'visible' => Yii::$app->user->can('/food/shop-staff/index')],
                            ['label' => '订单统计', 'icon' => 'fa fa-calendar-check-o ', 'url' => ['/food/order/index'], 'visible' => Yii::$app->user->can('/food/order/index')],
                    ['label' => '用户反馈', 'icon' => 'fa fa-commenting-o ', 'url' => ['/food/feedback/index'],],
//                        ],
//                        'visible'=>Yii::$app->user->can('/activitys/relayactivity/index')
//                    ],

                    ['label' => '用户信息', 'icon' => 'fa fa-street-view', 'url' => ['/sys/user/index'], 'visible' => Yii::$app->user->can('/sys/user/index')],

                ],
            ]
        );
        ?>

        <?php
        $sys = dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    [
                        'label' => '系统管理',
                        'icon' => 'fa fa-anchor',
                        'url' => '/sys/user/index',
                        'items' => [


                            ['label' => '微信用户', 'icon' => 'fa fa-weixin', 'url' => ['/sys/wechat/index'],'visible'=>Yii::$app->user->can('/sys/wechat/index')],
                            ['label' => '登录日志', 'icon' => 'fa fa-cloud', 'url' => ['/sys/loginlog/index'],'visible'=>Yii::$app->user->can('/sys/loginlog/index')],
                            ['label' => '地区信息', 'icon' => 'fa fa-paper-plane', 'url' => ['/sys/district/index'], 'visible' => Yii::$app->user->can('/sys/district/index')],
                            ['label' => '站点设置', 'icon' => 'fa fa-cog', 'url' => ['/setting/default/index'], 'visible' => Yii::$app->user->can('/setting/default/index')],
                            [
                                'label' => '权限设置',
                                'icon' => 'fa fa-key',
                                'url' => '/admin/assignment/index',
                                'items' => [
                                    ['label' => '路由', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/route/index'],'visible'=>Yii::$app->user->can('/admin/route/index')],
                                    //     ['label' => '权限', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/permission/index'],'visible'=>Yii::$app->user->can('/admin/permission/index')],
                                    ['label' => '角色', 'icon' => 'fa fa-circle-o', 'url' =>['/admin/role/index'],'visible'=>Yii::$app->user->can('/admin/role/index')],
                                    ['label' => '分配', 'icon' => 'fa fa-circle-o', 'url' =>['/admin/assignment/index'],'visible'=>Yii::$app->user->can('/admin/assignment/index')],
//                                    ['label' => '菜单', 'icon' => 'fa fa-circle-o', 'url' =>['/admin/menu/index'],'visible'=>Yii::$app->user->can('/admin/menu/index')],

                                ],
                                'visible'=>Yii::$app->user->can('/admin/assignment/index')
                            ],

                        ],
                        'visible'=>Yii::$app->user->can('/sys/user/index')
                    ],

                    [
                        'label' => '工具菜单',
                        'icon' => 'fa fa-random',
                        'url' => '/ui/icons',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-code', 'url' => ['/gii'],'visible'=>Yii::$app->user->can('/gii/*')],
                            ['label' => 'Debug', 'icon' => 'fa fa-bug', 'url' => ['/debug'],'visible'=>Yii::$app->user->can('/debug/*')],
                            ['label' => 'Icons-图标', 'icon' => 'fa fa-circle-o', 'url' => ['/ui/icons'],'visible'=>Yii::$app->user->can('/ui/icons')],
                            ['label' => 'Buttons-按钮', 'icon' => 'fa fa-circle-o', 'url' => ['/ui/buttons'],'visible'=>Yii::$app->user->can('/ui/buttons')],
                            ['label' => 'Timeline-时间轴', 'icon' => 'fa fa-circle-o', 'url' =>['/ui/timeline'],'visible'=>Yii::$app->user->can('/ui/timeline')],

                        ],
                        'visible'=>Yii::$app->user->can('/ui/icons')
                    ],

                ],
            ]
        );


        $role = Yii::$app->user->identity->role;
        if ($role < 3) {
            echo $sys;
        }

        
            echo \yii\bootstrap\Nav::widget(
                [
                    "encodeLabels" => false,
                    "options" => ["class" => "sidebar-menu"],
                    "items" => \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id),
                ]
            );
        ?>
</aside>

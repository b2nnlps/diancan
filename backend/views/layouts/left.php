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
                       [
                        'label' => '分销商城',
                        'icon' => 'fa fa-cubes',
                        'url' => '/merchant/product/index',
                        'items' => [
                            [
                                'label' => '商家中心',
                                'icon' => 'fa fa-street-view',
                                'url' => '/eshop/product/index',
                                'items' => [
                                    [
                                        'label' => '代理商品',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => ['/merchant/agent/index'],
                                'visible'=>Yii::$app->user->can('/merchant/agent/index')
                                    ],
                                    [
                                        'label' => '商品管理',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => ['/merchant/product/index'],
                                'visible'=>Yii::$app->user->can('/merchant/product/index')
                                    ],
                                    ['label' => '商品分类',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => ['/merchant/category/index'],
                                'visible'=>Yii::$app->user->can('/merchant/category/index')
                                    ],
                                    [
                                        'label' => '商家信息',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => ['/merchant/supplier/index'],
                                'visible'=>Yii::$app->user->can('/merchant/supplier/index')
                                    ],


                                ],
                                'visible'=>Yii::$app->user->can('/merchant/product/index')
                            ],

                            [
                                'label' => '会员管理',
                                'icon' => 'fa fa-user',
                                'url' => ['/merchant/member/index'],
                                'visible'=>Yii::$app->user->can('/merchant/member/index')
                            ],
                            [
                                'label' => '收货地址',
                                'icon' => 'fa fa-map-marker',
                                'url' => ['/merchant/address/index'],
                                'visible'=>Yii::$app->user->can('/merchant/address/index')
                            ],
                            [
                                'label' => '订单管理',
                                'icon' => 'fa fa-line-chart',
                                'url' => '/merchant/order/index',
                                'items' => [
                                    [
                                        'label' => '订单信息',
                                        'icon' => 'fa fa-pie-chart',
                                        'url' => ['/merchant/order/index'],
                                        'visible'=>Yii::$app->user->can('/merchant/order/index')
                                    ],
                                    [
                                        'label' => '订单商品',
                                        'icon' => 'fa  fa-camera-retro',
                                        'url' => ['/merchant/orderproduct/index'],
                                        'visible'=>Yii::$app->user->can('/merchant/orderproduct/index')
                                    ],
                                    [
                                        'label' => '订单状态',
                                        'icon' => 'fa fa-truck',
                                        'url' => ['/merchant/orderstatus/index'],
                                        'visible'=>Yii::$app->user->can('/merchant/orderstatus/index')
                                    ],
                                    [
                                        'label' => '购物车',
                                        'icon' => 'fa fa-shopping-cart',
                                        'url' => ['/merchant/cart/index'],
                                        'visible'=>Yii::$app->user->can('/merchant/cart/index')
                                    ],
                                ],
                                'visible'=>Yii::$app->user->can('/merchant/order/index')
                            ],
                        ],
                        'visible'=>Yii::$app->user->can('/merchant/product/index')
                    ],




				   ['label' => '会员管理', 'icon' => 'fa fa-user', 'url' => ['/sys/member/index'],'visible'=>Yii::$app->user->can('/sys/member/index')],
                    ['label' => '收货地址', 'icon' => 'fa fa-map-marker', 'url' => ['/sys/address/index'],'visible'=>Yii::$app->user->can('/sys/address/index')],
                    [
                        'label' => '订单管理',
                        'icon' => 'fa fa-line-chart',
                        'url' => '/eshop/order/index',
                        'items' => [
                            ['label' => '订单信息', 'icon' => 'fa fa-pie-chart', 'url' => ['/eshop/order/index'],'visible'=>Yii::$app->user->can('/eshop/order/index')],
                            ['label' => '订单商品', 'icon' => 'fa  fa-camera-retro', 'url' => ['/eshop/orderproduct/index'],'visible'=>Yii::$app->user->can('/eshop/orderproduct/index')],
                            ['label' => '订单状态', 'icon' => 'fa fa-truck', 'url' => ['/eshop/orderstatus/index'],'visible'=>Yii::$app->user->can('/eshop/orderstatus/index')],
                            ['label' => '购物车', 'icon' => 'fa fa-shopping-cart', 'url' => ['/eshop/cart/index'],'visible'=>Yii::$app->user->can('/eshop/cart/index')],
                        ],
                        'visible'=>Yii::$app->user->can('/eshop/order/index')
                    ],
                    [
                        'label' => '商家中心',
                        'icon' => 'fa fa-street-view',
                        'url' => '/eshop/product/index',
                        'items' => [
                            ['label' => '商品管理', 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/product/index'],'visible'=>Yii::$app->user->can('/eshop/product/index')],
                            ['label' => '商品分类', 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/category/index'],'visible'=>Yii::$app->user->can('/eshop/category/index')],
                            ['label' => '商家信息', 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/sumpplier/index'],'visible'=>Yii::$app->user->can('/eshop/sumpplier/index')],
                            ['label' => '代理商品', 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/agent/index'],'visible'=>Yii::$app->user->can('/eshop/agent/index')],
                        ],
                        'visible'=>Yii::$app->user->can('/eshop/product/index')
                    ],
                    [
                        'label' => '库存管理',
                        'icon' => 'fa fa-cubes',
                        'url' => '/eshop/depot/index',
                        'items' => [
                            ['label' => '库房信息', 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/depot/index'],'visible'=>Yii::$app->user->can('/eshop/depot/index')],
                            ['label' => '库存信息', 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/stock/index'],'visible'=>Yii::$app->user->can('/eshop/stock/index')],
                            ['label' => '库存记录', 'icon' => 'fa fa-circle-o', 'url' => ['/eshop/kcsl/index'],'visible'=>Yii::$app->user->can('/eshop/kcsl/index')],
                        ],
                        'visible'=>Yii::$app->user->can('/eshop/depot/index')
                    ],
					 [
                        'label' => '资讯管理',
                        'icon' => 'fa fa-database',
                        'url' => '/news/info/index',
                        'items' => [
                            [
                                'label' => '资讯信息',
                                'icon' => 'fa fa-circle-o',
                                'url' => ['/news/info/index'],
                                'visible'=>Yii::$app->user->can('/news/info/index')
                            ],
                            [
                                'label' => '资讯分类',
                                'icon' => 'fa fa-circle-o',
                                'url' => ['/news/category/index'],
                                'visible'=>Yii::$app->user->can('/news/category/index')
                            ],

                        ],
                        'visible'=>Yii::$app->user->can('/news/info/index')
                    ],
					  [
                        'label' => '活动管理',
                        'icon' => 'fa fa-hourglass-end',
                        'url' => '/activitys/relayactivity/index',
                        'items' => [
                            [
                                'label' => '微助力系统',
                                'icon' => 'fa fa-hand-pointer-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => '活动管理', 'icon' => 'fa fa-circle-o', 'url' => ['/activitys/relayactivity/index'],'visible'=>Yii::$app->user->can('/activitys/relayactivity/index')],
                                    ['label' => '报名管理', 'icon' => 'fa fa-circle-o', 'url' => ['/activitys/relayapplicant/index'],'visible'=>Yii::$app->user->can('/activitys/relayapplicant/index')],
                                    ['label' => '助力记录', 'icon' => 'fa fa-circle-o', 'url' => ['/activitys/relayrecord/index'],'visible'=>Yii::$app->user->can('/activitys/relayrecord/index')],
									['label' => '奖品管理', 'icon' => 'fa fa-circle-o', 'url' => ['/activitys/relayprize/index'],'visible'=>Yii::$app->user->can('/activitys/relayprize/index')],
                                    ['label' => '获奖记录', 'icon' => 'fa fa-circle-o', 'url' => ['/activitys/relayawards/index'],'visible'=>Yii::$app->user->can('/activitys/relayawards/index')],
                                ],
                            ],
                            [
                                'label' => '报名系统',
                                'icon' => 'fa fa-street-view',
                                'url' => '#',
                                'items' => [
                                    ['label' => '活动管理', 'icon' => 'fa fa-circle-o', 'url' => ['/activitys/applyactivity/index'],],
                                    ['label' => '报名管理', 'icon' => 'fa fa-circle-o', 'url' => ['/activitys/applyattend/index'],],
                                ],
                            ],

                        ],
                          'visible'=>Yii::$app->user->can('/activitys/relayactivity/index')
                    ],
                    [
                        'label' => '系统管理',
                        'icon' => 'fa fa-anchor',
                        'url' => '/sys/user/index',
                        'items' => [

                            ['label' => '后台用户', 'icon' => 'fa fa-users', 'url' => ['/sys/user/index'],'visible'=>Yii::$app->user->can('/sys/user/index')],
                            ['label' => '微信用户', 'icon' => 'fa fa-weixin', 'url' => ['/sys/wechat/index'],'visible'=>Yii::$app->user->can('/sys/wechat/index')],
                            ['label' => '登录日志', 'icon' => 'fa fa-cloud', 'url' => ['/sys/loginlog/index'],'visible'=>Yii::$app->user->can('/sys/loginlog/index')],
                            ['label' => '地区信息', 'icon' => 'fa fa-paper-plane', 'url' => ['/sys/district/index'],'visible'=>Yii::$app->user->can('/sys/district/index')],
                            ['label' => '图文信息', 'icon' => 'fa fa-newspaper-o', 'url' => ['/sys/teletext/index'],'visible'=>Yii::$app->user->can('/sys/teletext/index')],
                            ['label' => '验证信息', 'icon' => 'fa fa-cc-visa', 'url' => ['/sys/verification/index'],'visible'=>Yii::$app->user->can('/sys/verification/index')],
                            ['label' => '站点设置', 'icon' => 'fa fa-cog', 'url' => ['/setting/default/index'],'visible'=>Yii::$app->user->can('/setting/default/index')],
							['label' => 'Link信息', 'icon' => 'fa fa-newspaper-o', 'url' => ['/sys/link/index'],'visible'=>Yii::$app->user->can('/sys/link/index')],
                           [
                                'label' => '权限设置',
                                'icon' => 'fa fa-key',
                                'url' => '/admin/assignment/index',
                                'items' => [
                                    ['label' => '路由', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/route/index'],'visible'=>Yii::$app->user->can('/admin/route/index')],
                              //      ['label' => '权限', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/permission/index'],'visible'=>Yii::$app->user->can('/admin/permission/index')],
                                    ['label' => '角色', 'icon' => 'fa fa-circle-o', 'url' =>['/admin/role/index'],'visible'=>Yii::$app->user->can('/admin/role/index')],
                                    ['label' => '分配', 'icon' => 'fa fa-circle-o', 'url' =>['/admin/assignment/index'],'visible'=>Yii::$app->user->can('/admin/assignment/index')],
                               //     ['label' => '菜单', 'icon' => 'fa fa-circle-o', 'url' =>['/admin/menu/index'],'visible'=>Yii::$app->user->can('/admin/menu/index')],

                                ],
                                'visible'=>Yii::$app->user->can('/admin/assignment/index')
                            ],
//
//                            [
//                                'label' => '权限设置',
//                                'icon' => 'fa fa-key',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => '路由', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/route/index'],],
//                                    ['label' => '权限', 'icon' => 'fa fa-circle-o', 'url' => ['/admin/permission/index'],],
//                                    ['label' => '角色', 'icon' => 'fa fa-circle-o', 'url' =>['/admin/role/index'],],
//                                    ['label' => '分配', 'icon' => 'fa fa-circle-o', 'url' =>['/admin/assignment/index'],],
//                                    ['label' => '菜单', 'icon' => 'fa fa-circle-o', 'url' =>['/admin/menu/index'],],
//
//                                ],
//                            ],

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
        ?>

        <?php
            echo \yii\bootstrap\Nav::widget(
                [
                    "encodeLabels" => false,
                    "options" => ["class" => "sidebar-menu"],
                    "items" => \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id),
                ]
            );
        ?>


</aside>

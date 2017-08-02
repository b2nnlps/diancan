<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-member',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'member\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        //权限管理模块
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
        //系统设置管理模块
        'setting' => [
            'class' => 'funson86\setting\Module',
            'controllerNamespace' => 'funson86\setting\controllers'
        ],
        //系统公共模块
        'sys' => [
            'class' => 'member\modules\sys\Module',
        ],
        //e-shop模块
        'eshop' => [
            'class' => 'member\modules\eshop\Module',
        ],
		  //活动模块
        'activitys' => [
            'class' => 'member\modules\activitys\Module',
        ],
        'member' => [
            'class' => 'member\modules\member\Module',
        ],
        'food' => [
            'class' => 'member\modules\food\Module',
        ],
        
    ],
    'aliases'=> [
        '@mdm/admin'=> '@vendor/mdmsoft/yii2-admin',
    ],
    'as access' => [
        //ACF肯定是要加的，因为粗心导致该配置漏掉了，很是抱歉
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //这里是允许访问的action
            //controller/action
            'site/*',
            // '*'//允许所有人访问
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-member',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-member', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the member
            'name' => 'advanced-member',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        //调用布局文件
//		'view' => [
//             'theme' => [
//                 'pathMap' => [
//                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
//                 ],
//             ],
//		],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
       
        //components数组中加入authManager组件,有PhpManager和DbManager两种方式,    
        //PhpManager将权限关系保存在文件里,这里使用的是DbManager方式,将权限关系保存在数据库.    
        'authManager'=> [
            'class'=> 'yii\rbac\DbManager', //这里记得用单引号而不是双引号
            'defaultRoles' => ["guest"],
        ],
        'setting' => [
            'class' => 'funson86\setting\Setting',
        ],

    ],
    'params' => $params,
];

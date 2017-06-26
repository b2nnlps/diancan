<?php

namespace common\components\base;

use yii\web\Controller;


class BaseController extends Controller
{
  
     /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
                'ueditor' => [
                    'class' => 'crazyfd\ueditor\Upload',
                    'config' => [
                        'uploadDir' =>'upload/ueditor/'.date('Y/m/d')
                    ]
                ],
//                'upload' => [
//                    'class' => 'kucha\ueditor\UEditorAction',
//                    'config' => [
//                        "imageUrlPrefix"  => "",//图片访问路径前缀
//                        "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}" //上传保存路径
//                    ],
//                ]

            ];
    }

}

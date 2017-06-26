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
//                        "imageUrlPrefix"  => "",//ͼƬ����·��ǰ׺
//                        "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}" //�ϴ�����·��
//                    ],
//                ]

            ];
    }

}

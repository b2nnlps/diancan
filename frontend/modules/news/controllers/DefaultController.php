<?php

namespace frontend\modules\news\controllers;

use backend\modules\news\models\NewsInfo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `news` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionContent($id=''){
        $news=NewsInfo::findOne($id);
        if ($news !== null) {
            NewsInfo::updateAllCounters(['pv' => 1], ['id' =>$id]);//浏览次数加1
            return $this->render('content',[
                'news'=>$news,
            ]);
        } else {
            throw new NotFoundHttpException('没有该条记录！.');
        }

    }

}

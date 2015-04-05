<?php

namespace mii\modules\outlet\controllers;

class DefaultController extends \mii\web\Controller
{
    public function behaviors()
    {
        return [
            'httpCache' => [
                'class' => \yii\filters\HttpCache::className(),
                'only' => ['index'],
                // 'lastModified' => function ($action, $params) {
                //     $q = new Query();
                //     return strtotime($q->from('users')->max('updated_timestamp'));
                // },
                // 'etagSeed' => function ($action, $params) {
                    // return // generate etag seed here
                //}
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
}

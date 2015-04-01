<?php

namespace mii\modules\outlet\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{

    public function init()
    {
        //\Yii::$app->getModule('outlet')->setViewPath('@app/views/outlet');
        parent::init();
        // custom initialization code goes here
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}

<?php

namespace mii\modules\products\controllers;

class DefaultController extends \mii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
}

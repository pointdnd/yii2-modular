<?php

namespace mii\modules\admin\controllers;

class DefaultController extends \mii\web\AdminController
{

    public function actionIndex()
    {
        return $this->render('index');
    }
}

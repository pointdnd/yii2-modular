<?php

namespace mii\web;

class SiteController extends \mii\web\Controller
{
	public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => '@app/views/error',
            ],
        ];
    }
    public function actionIndex()
    {
    	echo "Hola...";
    }
}
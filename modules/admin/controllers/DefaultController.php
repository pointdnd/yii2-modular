<?php

namespace mii\modules\admin\controllers;

use yii\filters\AccessControl;

class DefaultController extends \mii\web\AdminController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return \Yii::$app->user->identity->getIsAdmin();
                        }
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
    	$this->layout = '/admin';
        return $this->render('index');
    }
}

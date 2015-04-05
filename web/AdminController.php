<?php

namespace mii\web;

class AdminController extends \mii\web\Controller
{
	public $layout = '@app/views/layouts/admin';

    public function init()
    {
        $this->layout='/admin';
        parent::init();
        // custom initialization code goes here
    }

    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => \yii\filters\AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'actions' => ['index'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                     'matchCallback' => function ($rule, $action) {
    //                         return \Yii::$app->user->identity->getIsAdmin();
    //                     }
    //                 ],
    //             ]
    //         ]
    //     ];
    // }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'index', 'delete', 'view','createAjax', 'updateAjax', 'indexAjax', 'deleteAjax', 'viewAjax'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['root','admin'],
                    ],
                    // everything else is denied by default
                ],
            ],
        ];
    }
}

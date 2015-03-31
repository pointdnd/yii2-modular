<?php

namespace mii\modules\booking\controllers;

class DefaultController extends \yii\web\Controller
{

    public function init()
    {
        //y('#booking')->setViewPath('@app/views/booking');
        parent::init();
        // custom initialization code goes here
    }

    public function actionIndex()
    {
        $searchModel = new \mii\modules\booking\models\ItemsSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

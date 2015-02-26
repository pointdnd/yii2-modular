<?php

namespace mii\components\rest;

use Yii;
use mii\modules\users\models\User;
use mii\modules\users\models\UserSearch;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response; 
use yii\filters\VerbFilter;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator; 
use yii\filters\RateLimiter; 
use yii\filters\AccessControl; 

/**
 * ApiController implements the CRUD actions for User model.
 */
class ActiveController extends \yii\rest\Controller
{
    public $serializer = [ 
       'class'=>'mii\components\rest\Serializer', 
    ];

    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
        \Yii::$app->user->loginUrl = null;
        \Yii::$app->response->on('beforeSend',function ($event) {
            $response = $event->sender;
            if ($response->data !== null and !$response->isSuccessful) {
                $response->data = [
                    'status' => $response->statusCode,
                    'message'=>$response->statusText,
                    'success' => (int)$response->isSuccessful,
                    'data' => $response->data,
                ];
            }
        });
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    //'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs(),
            ],
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    HttpBasicAuth::className(),
                    HttpBearerAuth::className(),
                    QueryParamAuth::className(),
                ],
            ],
            'rateLimiter' => [
                'class' => RateLimiter::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        return $this->serializeData($result);
    }

    /**
     * @inheritdoc
     */
    protected function serializeData($data)
    {
        return \Yii::createObject($this->serializer)->serialize($data);
    }
}

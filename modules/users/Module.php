<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace mii\modules\users;

use yii\authclient\Collection;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\i18n\PhpMessageSource;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;
use yii\web\User;

/**
 * This is the main module class for the Yii2-user.
 *
 * @property array $modelMap
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
     /**
     * @inheritdoc
     */
    public $controllerNamespace = 'mii\modules\users\controllers';
   
    const VERSION = '0.9.2';

    /** Email is changed right after user enter's new email address. */
    const STRATEGY_INSECURE = 0;

    /** Email is changed after user clicks confirmation link sent to his new email address. */
    const STRATEGY_DEFAULT = 1;

    /** Email is changed after user clicks both confirmation links sent to his old and new email addresses. */
    const STRATEGY_SECURE = 2;

    /** @var bool Whether to show flash messages. */
    public $enableFlashMessages = true;

    /** @var bool Whether to enable registration. */
    public $enableRegistration = true;

    /** @var bool Whether to remove password field from registration form. */
    public $enableGeneratingPassword = false;

    /** @var bool Whether user has to confirm his account. */
    public $enableConfirmation = true;

    /** @var bool Whether to allow logging in without confirmation. */
    public $enableUnconfirmedLogin = false;

    /** @var bool Whether to enable password recovery. */
    public $enablePasswordRecovery = true;

    /** @var integer Email changing strategy. */
    public $emailChangeStrategy = self::STRATEGY_DEFAULT;

    /** @var int The time you want the user will be remembered without asking for credentials. */
    public $rememberFor = 1209600; // two weeks

    /** @var int The time before a confirmation token becomes invalid. */
    public $confirmWithin = 86400; // 24 hours

    /** @var int The time before a recovery token becomes invalid. */
    public $recoverWithin = 21600; // 6 hours

    /** @var int Cost parameter used by the Blowfish hash algorithm. */
    public $cost = 10;

    /** @var array An array of administrator's usernames. */
    public $admins = ['root','admin'];
    
    /** @var array An array of administrator's usernames will be redirected. */
    public $adminRedirect = ['/admin'];
    
    /** @var array An array of normal's usernames will be redirected. if this value is true redirect to userprofile profile/show*/
    public $userProfileRedirect = true;

    /** @var array Mailer configuration */
    public $mailer = [];

    /** @var array Model map */
    public $modelMap = [];

    /**
     * @var string The prefix for user module URL.
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'users';

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        '<id:\d+>'                    => 'profile/show',
        '<action:(login|logout)>'     => 'security/<action>',
        '<action:(register|resend)>'  => 'registration/<action>',
        'confirm/<id:\d+>/<code:\w+>' => 'registration/confirm',
        'forgot'                      => 'recovery/request',
        'recover/<id:\d+>/<code:\w+>' => 'recovery/reset',
        'settings/<action:\w+>'       => 'settings/<action>'
    ];

    /** @var array Model's map */
    private $_modelMap = [
        'User'             => 'mii\modules\users\models\User',
        'Account'          => 'mii\modules\users\models\Account',
        'Profile'          => 'mii\modules\users\models\Profile',
        'Token'            => 'mii\modules\users\models\Token',
        'RegistrationForm' => 'mii\modules\users\models\RegistrationForm',
        'ResendForm'       => 'mii\modules\users\models\ResendForm',
        'LoginForm'        => 'mii\modules\users\models\LoginForm',
        'SettingsForm'     => 'mii\modules\users\models\SettingsForm',
        'RecoveryForm'     => 'mii\modules\users\models\RecoveryForm',
        'UserSearch'       => 'mii\modules\users\models\UserSearch',
    ];

    /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var $module Module */
        if ($app->hasModule('users') && ($module = $app->getModule('users')) instanceof Module) {
            $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);
            foreach ($this->_modelMap as $name => $definition) {
                $class = "mii\\modules\\users\\models\\" . $name;
                \Yii::$container->set($class, $definition);
                $modelName = is_array($definition) ? $definition['class'] : $definition;
                $module->modelMap[$name] = $modelName;
                if (in_array($name, ['User', 'Profile', 'Token', 'Account'])) {
                    \Yii::$container->set($name . 'Query', function () use ($modelName) {
                        return $modelName::find();
                    });
                }
            }
            \Yii::$container->setSingleton(Finder::className(), [
                'userQuery'    => \Yii::$container->get('UserQuery'),
                'profileQuery' => \Yii::$container->get('ProfileQuery'),
                'tokenQuery'   => \Yii::$container->get('TokenQuery'),
                'accountQuery' => \Yii::$container->get('AccountQuery'),
            ]);

            if ($app instanceof ConsoleApplication) {
                $module->controllerNamespace = 'mii\modules\users\commands';

                $app->get('i18n')->translations['users*'] = [
                    'class'    => PhpMessageSource::className(),
                    'basePath' => __DIR__ . '/messages',
                ];

            } else {
                try {
                    $app->user->enableAutoLogin = true;
                    $app->user->loginUrl        = ['/users/security/login'];
                    $app->user->identityClass   = $module->modelMap['User'];
                } catch (InvalidConfigException $e) {
                    $app->set('user', [
                        'class'           => User::className(),
                        'enableAutoLogin' => true,
                        'loginUrl'        => ['/users/security/login'],
                        'identityClass'   => $module->modelMap['User'],
                    ]);
                }

                $configUrlRule = [
                    'prefix' => $module->urlPrefix,
                    'rules'  => $module->urlRules
                ];

                if ($module->urlPrefix != 'users') {
                    $configUrlRule['routePrefix'] = 'users';
                }

                $app->get('urlManager')->rules[] = new GroupUrlRule($configUrlRule);
                $app->get('urlManager')->addRules([

                    'PUT,PATCH /'.$this->id.'/apis/<id>' => $this->id.'/api/update',
                    'DELETE /'.$this->id.'/apis/<id>' => $this->id.'/api/delete',
                    'GET,HEAD /'.$this->id.'/apis/<id>' => $this->id.'/api/view',
                    'POST /'.$this->id.'/apis' => $this->id.'/api/create',
                    'GET,HEAD /'.$this->id.'/apis' => $this->id.'/api/index',
                    'OPTIONS /'.$this->id.'/apis/<id>' => $this->id.'/api/options',
                    'OPTIONS /'.$this->id.'/apis' => $this->id.'/api/options',

                ],false);
                
                if (!$app->has('authClientCollection')) {
                    $app->set('authClientCollection', [
                        'class' => Collection::className(),
                    ]);
                }
            }

            $app->get('i18n')->translations['users*'] = [
                'class'    => PhpMessageSource::className(),
                'basePath' => __DIR__ . '/messages',
            ];

            $defaults = [
                'welcomeSubject'        => \Yii::t('users', 'Welcome to {0}', \Yii::$app->name),
                'confirmationSubject'   => \Yii::t('users', 'Confirm account on {0}', \Yii::$app->name),
                'reconfirmationSubject' => \Yii::t('users', 'Confirm email change on {0}', \Yii::$app->name),
                'recoverySubject'       => \Yii::t('users', 'Complete password reset on {0}', \Yii::$app->name)
            ];

            \Yii::$container->set('mii\modules\users\Mailer', array_merge($defaults, $module->mailer));
        }
        
    }

    public function getMenuAdmin()
    {
        return array(
            array('label'=>\Yii::t('app','Users'), 'icon'=>'fa fa-users', 'url'=>array('#'), 'items'=>array(
                array('label'=>\Yii::t('app','List of users'), 'url'=>array("/{$this->id}/admin/index")),
                array('label'=>\Yii::t('app','Create user'), 'url'=>array("/{$this->id}/admin/create")),
            )),
        );
    }
}

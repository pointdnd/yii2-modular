<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace mii\modules\users\models;

use mii\modules\users\Finder;
use yii\base\Model;
use mii\modules\users\helpers\Password;

/**
 * LoginForm get user's login and password, validates them and logs the user in. If user has been blocked, it adds
 * an error to login form.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class LoginForm extends Model
{
    /** @var string User's email or username */
    public $login;

    /** @var string User's plain password */
    public $password;

    /** @var string Whether to remember the user */
    public $rememberMe = false;

    /** @var \mii\modules\users\models\User */
    protected $user;

    /** @var \mii\modules\users\Module */
    protected $module;

    /** @var Finder */
    protected $finder;

    /**
     * @param Finder $finder
     * @param array $config
     */
    public function __construct(Finder $finder, $config = [])
    {
        $this->finder = $finder;
        $this->module = \Yii::$app->getModule('users');
        parent::__construct($config);
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'login'      => \Yii::t('users', 'Login'),
            'password'   => \Yii::t('users', 'Password'),
            'rememberMe' => \Yii::t('users', 'Remember me next time'),
        ];
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['login', 'trim'],
            ['password', function ($attribute) {
                if ($this->user === null || !Password::validate($this->password, $this->user->password_hash)) {
                    $this->addError($attribute, \Yii::t('users', 'Invalid login or password'));
                }
            }],
            ['login', function ($attribute) {
                if ($this->user !== null) {
                    $confirmationRequired = $this->module->enableConfirmation && !$this->module->enableUnconfirmedLogin;
                    if ($confirmationRequired && !$this->user->getIsConfirmed()) {
                        $this->addError($attribute, \Yii::t('users', 'You need to confirm your email address'));
                    }
                    if ($this->user->getIsBlocked()) {
                        $this->addError($attribute, \Yii::t('users', 'Your account has been blocked'));
                    }
                }
            }],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * Validates form and logs the user in.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return \Yii::$app->getUser()->login($this->user, $this->rememberMe ? $this->module->rememberFor : 0);
        } else {
            return false;
        }
    }

    /** @inheritdoc */
    public function formName()
    {
        return 'login-form';
    }

    /** @inheritdoc */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->user = $this->finder->findUserByUsernameOrEmail($this->login);
            return true;
        } else {
            return false;
        }
    }
}

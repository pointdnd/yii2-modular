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
use mii\modules\users\Mailer;
use yii\base\Model;

/**
 * Model for collecting data on password recovery.
 *
 * @property \mii\modules\users\Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RecoveryForm extends Model
{
    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var User */
    protected $user;

    /** @var \mii\modules\users\Module */
    protected $module;

    /** @var Mailer */
    protected $mailer;

    /** @var Finder */
    protected $finder;

    /**
     * @param Mailer $mailer
     * @param Finder $finder
     * @param array  $config
     */
    public function __construct(Mailer $mailer, Finder $finder, $config = [])
    {
        $this->module = \Yii::$app->getModule('users');
        $this->mailer = $mailer;
        $this->finder = $finder;
        parent::__construct($config);
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'email'    => \Yii::t('users', 'Email'),
            'password' => \Yii::t('users', 'Password'),
        ];
    }

    /** @inheritdoc */
    public function scenarios()
    {
        return [
            'request' => ['email'],
            'reset'   => ['password']
        ];
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => $this->module->modelMap['User'],
                'message' => \Yii::t('users', 'There is no user with such email.')
            ],
            ['email', function ($attribute) {
                $this->user = $this->finder->findUserByEmail($this->email);
                if ($this->user !== null && $this->module->enableConfirmation && !$this->user->getIsConfirmed()) {
                    $this->addError($attribute, \Yii::t('users', 'You need to confirm your email address'));
                }
            }],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Sends recovery message.
     *
     * @return bool
     */
    public function sendRecoveryMessage()
    {
        if ($this->validate()) {
            /** @var Token $token */
            $token = \Yii::createObject([
                'class'   => Token::className(),
                'user_id' => $this->user->id,
                'type'    => Token::TYPE_RECOVERY
            ]);
            $token->save(false);
            $this->mailer->sendRecoveryMessage($this->user, $token);
            \Yii::$app->session->setFlash('info', \Yii::t('users', 'You will receive an email with instructions on how to reset your password in a few minutes.'));
            return true;
        }

        return false;
    }

    /**
     * Resets user's password.
     *
     * @param  Token $token
     * @return bool
     */
    public function resetPassword(Token $token)
    {
        if (!$this->validate() || $token->user === null) {
            return false;
        }

        if ($token->user->resetPassword($this->password)) {
            \Yii::$app->session->setFlash('success', \Yii::t('users', 'Your password has been changed successfully.'));
            $token->delete();
        } else {
            \Yii::$app->session->setFlash('danger', \Yii::t('users', 'An error occurred and your password has not been changed. Please try again later.'));
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return 'recovery-form';
    }
}

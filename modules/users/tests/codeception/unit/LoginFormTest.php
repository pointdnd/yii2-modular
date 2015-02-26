<?php

namespace mii\modules\users\tests;

use Codeception\Specify;
use
    mii\modules\users\models\LoginForm;
use tests\codeception\fixtures\UserFixture;
use yii\codeception\TestCase;

class LoginFormTest extends TestCase
{
    use Specify;

    /**
     * @var LoginForm
     */
    protected $form;

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'users' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/fixtures/data/init_user.php'
            ],
        ];
    }

    public function testLogin()
    {
        $this->form = \Yii::createObject(LoginForm::className());

        $this->specify('should not allow logging in blocked users', function () {
            $user = $this->getFixture('users')->getModel('blocked');
            $this->form->setAttributes([
                'login'    => $user->email,
                'password' => 'qwerty'
            ]);
            verify($this->form->validate())->false();
            verify($this->form->getErrors('login'))->contains('Your account has been blocked');
        });

        $this->specify('should not allow logging in unconfirmed users', function () {
            \Yii::$app->getModule('users')->enableConfirmation = true;
            \Yii::$app->getModule('users')->enableUnconfirmedLogin = false;
            $user = $this->getFixture('users')->getModel('users');
            $this->form->setAttributes([
                'login'    => $user->email,
                'password' => 'qwerty'
            ]);
            verify($this->form->validate())->true();
            $user = $this->getFixture('users')->getModel('unconfirmed');
            $this->form->setAttributes([
                'login'    => $user->email,
                'password' => 'unconfirmed'
            ]);
            verify($this->form->validate())->false();
        });

        $this->specify('should log the user in with correct credentials', function () {
            $user = $this->getFixture('users')->getModel('users');
            $this->form->setAttributes([
                'login'    => $user->email,
                'password' => 'wrong'
            ]);
            verify($this->form->validate())->false();
            $this->form->setAttributes([
                'login'    => $user->email,
                'password' => 'qwerty'
            ]);
            verify($this->form->validate())->true();
        });
    }
}

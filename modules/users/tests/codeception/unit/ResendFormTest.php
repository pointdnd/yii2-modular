<?php

namespace mii\modules\users\tests;

use mii\modules\users\models\ResendForm;
use tests\codeception\fixtures\UserFixture;
use yii\codeception\TestCase;

class ResendFormTest extends TestCase
{
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

    public function testValidateEmail()
    {
        $form = \Yii::createObject(ResendForm::className());
        $user = $this->getFixture('users')->getModel('users');
        $form->setAttributes([
            'email' => $user->email,
        ]);
        $this->assertFalse($form->validate());

        $form = \Yii::createObject(ResendForm::className());
        $user = $this->getFixture('users')->getModel('unconfirmed');
        $form->setAttributes([
            'email' => $user->email,
        ]);
        $this->assertTrue($form->validate());
    }
}

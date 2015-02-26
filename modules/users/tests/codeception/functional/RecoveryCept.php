<?php

use tests\codeception\_pages\RecoveryPage;
use tests\codeception\_pages\LoginPage;
use yii\helpers\Html;
use yii\helpers\Url;
use mii\modules\users\models\User;
use mii\modules\users\models\Token;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that password recovery works');

$page = RecoveryPage::openBy($I);

$I->amGoingTo('try to request recovery token for unconfirmed account');
$user = $I->getFixture('users')->getModel('unconfirmed');
$page->recover($user->email);
$I->see('You need to confirm your email address');

$I->amGoingTo('try to request recovery token');
$user = $I->getFixture('users')->getModel('users');
$page->recover($user->email);
$I->see('You will receive an email with instructions on how to reset your password in a few minutes.');
$user = $I->grabRecord(User::className(), ['email' => $user->email]);
$token = $I->grabRecord(Token::className(), ['user_id' => $user->id, 'type' => Token::TYPE_RECOVERY]);
$I->seeInEmail(Html::encode($token->getUrl()));
$I->seeInEmailRecipients($user->email);

$I->amGoingTo('reset password with invalid token');
$user = $I->getFixture('users')->getModel('user_with_expired_recovery_token');
$token = $I->grabRecord(Token::className(), ['user_id' => $user->id, 'type' => Token::TYPE_RECOVERY]);
$I->amOnPage(Url::toRoute(['/users/recovery/reset', 'id' => $user->id, 'code' => $token->code]));
$I->see('Recovery link is invalid or out-of-date. Please try requesting a new one.');

$I->amGoingTo('reset password');
$user = $I->getFixture('users')->getModel('user_with_recovery_token');
$token = $I->grabRecord(Token::className(), ['user_id' => $user->id, 'type' => Token::TYPE_RECOVERY]);
$I->amOnPage(Url::toRoute(['/users/recovery/reset', 'id' => $user->id, 'code' => $token->code]));
$I->fillField('#recovery-form-password', 'newpass');
$I->click('Finish');
$I->see('Your password has been changed successfully.');

$page = LoginPage::openBy($I);
$page->login($user->email, 'qwerty');
$I->see('Invalid login or password');
$page->login($user->email, 'newpass');
$I->dontSee('Invalid login or password');

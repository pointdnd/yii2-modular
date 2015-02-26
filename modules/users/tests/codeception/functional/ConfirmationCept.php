<?php

use yii\helpers\Url;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that confirmation works');

$I->amGoingTo('check that error is showed when token expired');
$token = $I->getFixture('token')->getModel('expired_confirmation');
$I->amOnPage(Url::toRoute(['/users/registration/confirm', 'id' => $token->user_id, 'code' => $token->code]));
$I->see('Confirmation link is invalid or out-of-date. You can try requesting a new one.');

$I->amGoingTo('check that user get confirmed');
$token = $I->getFixture('token')->getModel('confirmation');
$I->amOnPage(Url::toRoute(['/users/registration/confirm', 'id' => $token->user_id, 'code' => $token->code]));
$I->see('Your account has been successfully confirmed.');
$I->see('Logout');

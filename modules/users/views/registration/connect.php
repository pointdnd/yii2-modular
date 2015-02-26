<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\modules\users\models\User $model
 * @var app\modules\users\models\Account $account
 */

$this->title = Yii::t('users', 'Connect your account to {0}', $account->provider);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <div class="alert alert-info">
                    <p>
                        <?= Yii::t('users', 'Looks like this is first time you are using {0} account to sign in to {1}', [$account->provider, Yii::$app->name]) ?>.
                        <?= Yii::t('users', 'Connect this account by entering desired username and your email address below') ?>.
                        <?= Yii::t('users', 'You will never have to use this form again') ?>.
                    </p>
                </div>
                <?php $form = ActiveForm::begin([
                    'id' => 'connect-account-form',
                ]); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'email') ?>

                <?= Html::submitButton(Yii::t('users', 'Finish'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('users', 'If you already registered, sign in and connect this account on settings page'), ['/users/security/login']) ?>.
        </p>
    </div>
</div>

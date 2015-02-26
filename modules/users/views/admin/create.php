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
 * @var yii\web\View              $this
 * @var app\modules\users\models\User $user
 */

$this->title = Yii::t('users', 'Create a user account');
$this->params['title'] = Html::encode($this->title);
$this->params['icon'] = 'fa-user';
$this->params['subtitle'] = Html::encode($this->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('users', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', [
    'module' => Yii::$app->getModule('users'),
]) ?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation'   => true,
    'enableClientValidation' => false
]); ?>

<div class="text-right">
    <?= Html::submitButton(Yii::t('users', 'Save'), ['class' => 'btn btn-success']) ?>
    <?= Html::a(Yii::t('users', 'Back'), ['index'], ['class' => 'btn btn-default']) ?>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <div class="alert alert-info">
                    <?= Yii::t('users', 'Credentials will be sent to user by email') ?>.
                    <?= Yii::t('users', 'If you want to be generate password automatically leave password field empty') ?>.
                </div>

                <?= $this->render('_user', ['form' => $form, 'user' => $user]) ?>

            </div>
        </div>
    </div>
</div>
<div class="text-right">
    <?= Html::submitButton(Yii::t('users', 'Save'), ['class' => 'btn btn-success']) ?>
    <?= Html::a(Yii::t('users', 'Back'), ['index'], ['class' => 'btn btn-default']) ?>
</div>
<?php ActiveForm::end(); ?>

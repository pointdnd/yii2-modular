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
 * @var yii\web\View                 $this
 * @var app\modules\users\models\User    $user
 * @var app\modules\users\models\Profile $profile
 * @var app\modules\users\Module         $module
 */

$this->title = Yii::t('users', 'Update user account');
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
<div class="mbm text-right">
    <?= Html::submitButton(Yii::t('users', 'Save'), ['class' => 'btn btn-primary']) ?>
    <?php if (!$user->getIsConfirmed()): ?>
        <?= Html::a(Yii::t('users', 'Confirm'), ['confirm', 'id' => $user->id, 'back' => 'update'], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
    <?php endif; ?>
    <?php if ($user->getIsBlocked()): ?>
        <?= Html::a(Yii::t('users', 'Unblock'), ['block', 'id' => $user->id, 'back' => 'update'], ['class' => 'btn btn-success', 'data-method' => 'post', 'data-confirm' => Yii::t('users', 'Are you sure to block this user?')]) ?>
    <?php else: ?>
        <?= Html::a(Yii::t('users', 'Block'), ['block', 'id' => $user->id, 'back' => 'update'], ['class' => 'btn btn-danger', 'data-method' => 'post', 'data-confirm' => Yii::t('users', 'Are you sure to block this user?')]) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('users', 'Back'), ['index'], ['class' => 'btn btn-default']) ?>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <?= $this->render('_user', ['form' => $form, 'user' => $user]) ?>
            </div>
        </div>
        
        <div class="alert alert-info">
            <?= Yii::t('users', 'Registered at {0, date, MMMM dd, YYYY HH:mm} from {1}', [$user->created_at, is_null($user->registration_ip) ? 'N/D' : $user->registration_ip]) ?>
        </div>
        <?php if ($module->enableConfirmation && $user->getIsConfirmed()): ?>
            <div class="alert alert-success">
                <?= Yii::t('users', 'Confirmed at {0, date, MMMM dd, YYYY HH:mm}', [$user->created_at]) ?>
            </div>
        <?php endif; ?>
        <?php if ($user->getIsBlocked()): ?>
            <div class="alert alert-danger">
                <?= Yii::t('users', 'Blocked at {0, date, MMMM dd, YYYY HH:mm}', [$user->blocked_at]) ?>
            </div>
        <?php endif;?>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('users', 'Update user profile') ?>
            </div>
            <div class="panel-body">
                <?= $this->render('_profile', ['form' => $form, 'profile' => $profile]) ?>
            </div>
        </div>
    </div>
</div>

<div class="text-right">
    <?= Html::submitButton(Yii::t('users', 'Save'), ['class' => 'btn btn-primary']) ?>
    <?php if (!$user->getIsConfirmed()): ?>
        <?= Html::a(Yii::t('users', 'Confirm'), ['confirm', 'id' => $user->id, 'back' => 'update'], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
    <?php endif; ?>
    <?php if ($user->getIsBlocked()): ?>
        <?= Html::a(Yii::t('users', 'Unblock'), ['block', 'id' => $user->id, 'back' => 'update'], ['class' => 'btn btn-success', 'data-method' => 'post', 'data-confirm' => Yii::t('users', 'Are you sure to block this user?')]) ?>
    <?php else: ?>
        <?= Html::a(Yii::t('users', 'Block'), ['block', 'id' => $user->id, 'back' => 'update'], ['class' => 'btn btn-danger', 'data-method' => 'post', 'data-confirm' => Yii::t('users', 'Are you sure to block this user?')]) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('users', 'Back'), ['index'], ['class' => 'btn btn-default']) ?>
</div>
<?php ActiveForm::end(); ?>

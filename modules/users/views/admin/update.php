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
 * @var mii\modules\users\models\User    $user
 * @var mii\modules\users\models\Profile $profile
 * @var mii\modules\users\Module         $module
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
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('users', 'Update roles') ?>
            </div>
            <div class="panel-body">
                <table class="table">
                <tr>
                    <th colspan="2"><?=y('app','Roles')?></th>
                </tr>
                <?php foreach(\mii\modules\users\models\AuthItems::find()->where(['type'=>1])->all() as $data):?>
                <?php if($data->name==='root') continue;?>
                <tr>
                    <td>
                        <?=$data->name?> 
                    </td>
                    <td class="text-right">
                    <?php if(y('.authManager')->checkAccess($user->id,$data->name)):?>
                        <a href="#" class="btn btn-success">Enabled</a>
                    <?php else:?>
                        <a href="#" class="btn btn-danger">Disabled</a>
                    <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</div>

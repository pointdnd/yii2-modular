<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var app\modules\users\models\Token $token
 */
?>
<?= Yii::t('users', 'Hello') ?>,

<?= Yii::t('users', 'You have recently requested email change on {0}', Yii::$app->name) ?>.
<?= Yii::t('users', 'In order to complete your request, please click the link below') ?>.

<?= $token->url ?>

<?= Yii::t('users', 'If you have problems, please paste the above URL into your web browser') ?>.
<?= Yii::t('users', 'This URL will only be valid for a limited time and will expire') ?>.

<?= Yii::t('users', 'P.S. If you received this email by mistake, simply delete it') ?>.

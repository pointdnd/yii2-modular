<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator app\modules\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

$module = \Yii::$app->getModule('gii');
$hideAttributes = $module->hideAttributes();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
    
    <?= "<?php " ?>$form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ]); ?>
    
    <div class="form-group text-right">
        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> ' . <?= $generator->generateString('Create') ?> : '<i class="fa fa-save"></i> ' . <?= $generator->generateString('Update') ?>, ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::a('<i class="fa fa-chevron-left"></i> ' . <?= $generator->generateString('Back') ?>, ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <div class="row">
<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        if(in_array($attribute, $hideAttributes)) {
            continue;
        }
        echo "    <div class=\"col-lg-6\">\n";
        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
        echo "    </div>\n";
    }
} ?>
    </div>

    <div class="form-group text-right">
        <?= "<?= " ?>Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> ' . <?= $generator->generateString('Create') ?> : '<i class="fa fa-save"></i> ' . <?= $generator->generateString('Update') ?>, ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::a('<i class="fa fa-chevron-left"></i> ' . <?= $generator->generateString('Back') ?>, ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>

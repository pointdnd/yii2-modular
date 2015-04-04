<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mii\modules\contact\models\Messages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="messages-form">
    
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ]); ?>
    
    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> ' . 'Create' : '<i class="fa fa-save"></i> ' . 'Update', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . 'Back', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <div class="row">
    <div class="col-lg-6">
    <?= $form->field($model, 'name')->widget(y('TextField')->class,[
                    'allowed' => 255,
                    'options' => array('class'=>'form-control'),
                ]) ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'email')->widget(y('TextField')->class,[
                    'allowed' => 255,
                    'options' => array('class'=>'form-control'),
                ]) ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'phone')->widget(y('TextField')->class,[
                    'allowed' => 100,
                    'options' => array('class'=>'form-control'),
                ]) ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'sent')->checkbox() ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'read')->checkbox() ?>

    </div>
    </div>
    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> ' . 'Create' : '<i class="fa fa-save"></i> ' . 'Update', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . 'Back', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

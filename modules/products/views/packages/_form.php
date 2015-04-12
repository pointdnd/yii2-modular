<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mii\modules\products\models\Packages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packages-form">
    
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
                    'allowed' => 150,
                    'options' => array('class'=>'form-control'),
                ]) ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'owner')->widget(y('TextField')->class,[
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
    <?= $form->field($model, 'money')->widget(y('TextField')->class,[
                    'allowed' => 11,
                    'options' => array('class'=>'form-control'),
                ]) ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'info')->textarea(array('rows'=>10,'cols'=>5)); ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'files')->widget(y('Upload')->class,[
                'allowedExtensions' => array('png','jpg','jpeg','csv','xls','xlsx','doc','docx','pdf','rar','zip','txt','mp4','mp3','mov','swf'),
                'iconButtom' => 'fa-cloud-upload',
                'actionUrl' => y('.urlManager')->createUrl($this->context->module->id.'/'.$this->context->id.'/upload'),
            ]) ?>

    </div>
    </div>
    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> ' . 'Create' : '<i class="fa fa-save"></i> ' . 'Update', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . 'Back', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

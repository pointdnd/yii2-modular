<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mii\modules\products\models\Lists */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lists-form">
    
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
    <?= $form->field($model, 'title')->widget(y('TextField')->class,[
                    'allowed' => 255,
                    'options' => array('class'=>'form-control'),
                ]) ?>
    <?= $form->field($model, 'price')->widget(y('TextField')->class,[
                    'allowed' => 11,
                    'options' => array('class'=>'form-control'),
                ]) ?>
    <?= $form->field($model, 'description')->textarea(array('rows'=>10,'cols'=>5)); ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'image')->widget(y('Upload')->class,[
                // 'sizeValidate' => array('width'=>'500','height'=>'500'),
                'allowedExtensions' => array('png','jpg','jpeg'),
                // 'iconButtom' => 'fa-cloud-upload',
                'actionUrl' => y('.urlManager')->createUrl($this->context->module->id.'/'.$this->context->id.'/upload'),
         
            ]) ?>

    </div>
    <!--
    <div class="col-lg-6">
    <?= $form->field($model, 'products_packages_id')->widget(y('TextField')->class,[
                    'allowed' => 11,
                    'options' => array('class'=>'form-control'),
                ]) ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'orden_id')->widget(y('TextField')->class,[
                    'allowed' => 11,
                    'options' => array('class'=>'form-control'),
                ]) ?>

    </div>
    -->
    </div>
    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> ' . 'Create' : '<i class="fa fa-save"></i> ' . 'Update', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . 'Back', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

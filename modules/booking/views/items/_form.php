<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\booking\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">
    
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ]); ?>
    
    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> ' . Yii::t('app', 'Create') : '<i class="fa fa-save"></i> ' . Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <div class="row">
    <div class="col-lg-6">
    <?= $form->field($model, 'name')->widget(y('TextField')->class,[
                    'allowed' => 255,
                    'options' => array('class'=>'form-control'),
                ]) ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'image')->widget(y('Upload')->class,[
                // 'sizeValidate' => array('width'=>'500','height'=>'500'),
                'allowedExtensions' => array('png','jpg','jpeg'),
                // 'iconButtom' => 'fa-cloud-upload',
                'actionUrl' => y('.urlManager')->createUrl($this->context->module->id.'/'.$this->context->id.'/upload'),
         
            ]) ?>

    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'map_address')->widget(y('Map')->class,[
                'options' => array('class'=>'form-control'),
            ]) ?>

    </div>
    </div>
    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> ' . Yii::t('app', 'Create') : '<i class="fa fa-save"></i> ' . Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

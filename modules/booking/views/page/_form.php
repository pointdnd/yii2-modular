<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mii\modules\booking\models\Items */
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


    <?= y('TextField')->widget([
                    'model' => $model,
                    'attribute' => 'name',
                    'allowed' => 255,
                    'options' => array('class'=>'form-control'),
                ]) ?>

    <?= y('TextArea')->widget([
                'model' => $model,
                'attribute' => 'description',
                'options' => array('class'=>'form-control'),
            ]) ?>

    <?= y('Upload')->widget([
                'model' => $model,
                'attribute' => 'image',
                // 'sizeValidate' => array('width'=>'500','height'=>'500'),
                'allowedExtensions' => array('png','jpg','jpeg'),
                // 'iconButtom' => 'fa-cloud-upload',
                'actionUrl' => y('.urlManager')->createUrl('upload'),
         
            ]) ?>

    <div class="form-group text-right">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> ' . Yii::t('app', 'Create') : '<i class="fa fa-save"></i> ' . Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

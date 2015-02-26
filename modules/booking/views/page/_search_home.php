<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\booking\models\ItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-search">

<?php $form = ActiveForm::begin([
    'action' => ['page/index'],
    'method' => 'get',
]); ?>

<div class="col-lg-2"></div>
<div class="col-lg-8 text-center">

<div class="input-group mbl">
  <input type="text" class="form-control input-lg" placeholder="Search by destination, property ID, or keyword">
  <span class="input-group-btn">
    <button class="btn btn-primary btn-lg" type="submit"><?=\Yii::t('app', 'Search')?></button>
  </span>
</div><!-- /input-group -->

<em>Do you have an apartment holiday for rent?</em> <br>
<a class="" href="#" role="button">Publish now »</a>

</div><!-- /.col-lg-6 -->
<?php ActiveForm::end(); ?>
</div>

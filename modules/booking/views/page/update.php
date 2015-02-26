<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\booking\models\Items */

$this->title = $this->context->title;
$this->params['title'] = Html::encode($this->title);
$this->params['icon'] = $this->context->icon;
$this->params['subtitle'] = Html::encode($this->context->subTitle);$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<section class="container">
<div class="row">
<div class="items-update col-lg-12">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</section>

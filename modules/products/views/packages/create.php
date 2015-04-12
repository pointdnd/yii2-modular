<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model mii\modules\products\models\Packages */

$this->title = $this->context->title;
$this->params['title'] = Html::encode($this->title);
$this->params['icon'] = $this->context->icon;
$this->params['subtitle'] = Html::encode($this->context->subTitle);
$this->params['breadcrumbs'][] = ['label' => 'Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

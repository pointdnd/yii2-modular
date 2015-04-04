<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model mii\modules\contact\models\Messages */

$this->title = $this->context->title;
$this->params['title'] = Html::encode($this->title);
$this->params['icon'] = $this->context->icon;
$this->params['subtitle'] = Html::encode($this->context->subTitle);
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

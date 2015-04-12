<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model mii\modules\products\models\Lists */

$this->title = $this->context->title;
$this->params['title'] = Html::encode($this->title);
$this->params['icon'] = $this->context->icon;
$this->params['subtitle'] = Html::encode($this->context->subTitle);
$this->params['breadcrumbs'][] = ['label' => 'Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lists-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

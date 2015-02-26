<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model mii\modules\booking\models\Items */

$this->title = $this->context->title;
$this->params['title'] = Html::encode($this->title);
$this->params['icon'] = $this->context->icon;
$this->params['subtitle'] = Html::encode($this->context->subTitle);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="container">
<div class="row">
<div class="items-view col-lg-12">

    <p class="text-right">
        <?= Html::a('<i class="fa fa-pencil"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'image',
            'created_at',
        ],
    ]) ?>

</div>
</div>
</section>

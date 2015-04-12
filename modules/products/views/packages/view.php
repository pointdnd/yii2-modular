<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model mii\modules\products\models\Packages */

$this->title = $this->context->title;
$this->params['title'] = Html::encode($this->title);
$this->params['icon'] = $this->context->icon;
$this->params['subtitle'] = Html::encode($this->context->subTitle);
$this->params['breadcrumbs'][] = ['label' => 'Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packages-view">

    <p class="text-right">
        <?= Html::a('<i class="fa fa-pencil"></i> ' . 'Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o"></i> ' . 'Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . 'Back', ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'owner',
            'email:email',
            'phone',
            'money',
            'info:ntext',
            'files',
        ],
    ]) ?>

</div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions'  => ['class' => 'table table-striped'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'format'=>'raw',
                'value'=>function($model){ return "<img src='".$model->image_path."' class=\"img-thumbnail\" style=\"width:100px\" alt=\"\">"; },
            ],
            'title',
            // 'description:ntext',
            'price',
            // 'products_packages_id',
            // 'orden_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=> [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-folder-open"></i>', $url, [
                            'title' => Yii::t('yii', 'View'),
                            'class'=>'btn btn-success',
                            'data-pjax' => '0',
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-pencil-square"></i>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'class'=>'btn btn-primary',
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'class'=>'btn btn-danger',
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel mii\modules\contact\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $this->context->title;
$this->params['title'] = Html::encode($this->title);
$this->params['icon'] = $this->context->icon;
$this->params['subtitle'] = Html::encode($this->context->subTitle);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> ' . 'Create Messages', ['create'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions'  => ['class' => 'table table-striped'],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'phone',
            'message:ntext',
            // 'created_at',
            'sent',
            'read',

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

</div>

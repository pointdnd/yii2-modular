<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\users\models\UserSearch $searchModel
 */

$this->title = Yii::t('users', 'Manage users');
$this->params['title'] = Html::encode($this->title);
$this->params['icon'] = 'fa-users';
$this->params['subtitle'] = Html::encode($this->title);
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::a(Yii::t('users', 'Create a user account'), ['create'], ['class' => 'btn btn-primary pull-right mbm']) ?>

<?= $this->render('/_alert', [
    'module' => Yii::$app->getModule('users'),
]) ?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'tableOptions'  => ['class' => 'table table-striped'],
    'layout'  => "{items}\n{pager}",
    'columns' => [
        'username',
        'email:email',
        [
            'attribute' => 'registration_ip',
            'value' => function ($model) {
                    return $model->registration_ip == null
                        ? '<span class="not-set">' . Yii::t('users', '(not set)') . '</span>'
                        : $model->registration_ip;
                },
            'format' => 'html',
        ],
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                return Yii::t('users', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
            }
        ],
        [
            'header' => Yii::t('users', 'Confirmation'),
            'value' => function ($model) {
                if ($model->isConfirmed) {
                    return '<div class="text-center"><span class="text-success">' . Yii::t('users', 'Confirmed') . '</span></div>';
                } else {
                    return Html::a(Yii::t('users', 'Confirm'), ['confirm', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-success btn-block',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('users', 'Are you sure to confirm this user?'),
                    ]);
                }
            },
            'format' => 'raw',
            'visible' => Yii::$app->getModule('users')->enableConfirmation
        ],
        [
            'header' => Yii::t('users', 'Block status'),
            'value' => function ($model) {
                if ($model->isBlocked) {
                    return Html::a(Yii::t('users', 'Unblock'), ['block', 'id' => $model->id], [
                        'class' => 'btn btn-success btn-block',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('users', 'Are you sure to unblock this user?')
                    ]);
                } else {
                    return Html::a(Yii::t('users', 'Block'), ['block', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-block',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('users', 'Are you sure to block this user?')
                    ]);
                }
            },
            'format' => 'raw',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons'=> [
                'view' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                        'title' => Yii::t('yii', 'View'),
                        'class'=>'btn btn-success',
                        'data-pjax' => '0',
                    ]);
                },
                'update' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Update'),
                        'class'=>'btn btn-primary',
                        'data-pjax' => '0',
                    ]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'class'=>'btn btn-primary',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'data-method' => 'post',
                        'data-pjax' => '0',
                    ]);
                },
            ],
        ],
    ],
]); ?>

<?php Pjax::end() ?>

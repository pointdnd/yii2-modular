<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\booking\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $this->context->title;
$this->params['title'] = Html::encode($this->title);
$this->params['icon'] = $this->context->icon;
$this->params['subtitle'] = Html::encode($this->context->subTitle);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jumbotron booking-default-index">
    <div class="container">
        <?php echo $this->render('../page/_search_home', ['model' => $searchModel]); ?>
    </div>
</div>
<section class="container">

<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "<div class=\"text-center\">{summary}</div>\n{items}\n <div class=\"text-center\">{pager}</div>",
        // 'pager' => ['options'=>['class' => 'pager']],
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return '
            <div class="row">
                <div class="col-lg-4">
                    <img style="width:100%" src="'.$model->image_path.'" alt="..." class="img-thumbnail mtl">
                </div>
                <div class="col-lg-8">
                <div class="post-preview">
                        <h2 class="post-title">
                            '.\yii\helpers\Html::a(\yii\helpers\Html::encode($model->name), ['page/view', 'id' => $model->id]).'
                        </h2>
                        <em class="post-preview text-muted">
                            '.\yii\helpers\Html::encode(substr($model->description, 0,100)).'...
                        </em>
                    <p class="post-meta">Posted by <a href="#">Diego canoba</a> on September 24, 2014</p>
                </div>
                </div>
                <hr>
            </div>
            ';
        },
    ]) ?>
    </div>
</div>

</section>


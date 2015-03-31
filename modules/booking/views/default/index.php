<?php $this->title = 'Booking';?>
<div class="jumbotron booking-default-index text-center" style="">
  <div class="container">
    <h1 class="jumbotron-h2">Found your <?=\Yii::$app->id?></h1>  
    <?php echo $this->render('../page/_search_home', ['model' => $searchModel]); ?>

  </div>
</div>
<section id="blog" class="blog-1 bg-lighter">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Most popular Appartment on the world!</h2>
            </div>
        </div>
    </div>
</section>
<section class="container">

<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n <div class=\"text-center\">{pager}</div>",
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

            return '
            <div class="row blog-row">
            <div class="col-md-6 blog-col" data-scrollreveal="enter bottom over 1.5s" data-sr-init="true" data-sr-complete="true">
                <a href="#" class="blog-preview-img">
                    <img style="width:100%" src="'.$model->image_path.'" alt="..." class="img-thumbnail mtl">
                </a>
                <div class="blog-preview-content">
                    <h3>
                        <a href="#">Blog Post Title</a>
                    </h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, quisquam, sunt, corporis.</p>
                    <div class="continue"><a href="#">Continue Reading →</a>
                    </div>
                    <ul class="meta list-inline">
                        <li>February 31, 2014</li>
                        <li>9 Comments</li>
                        <li><i class="fa fa-heart text-primary"></i> 12</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 blog-col" data-scrollreveal="enter right over 1.5s" data-sr-init="true" data-sr-complete="true">
                <a href="#" class="blog-preview-img">
                    <img style="width:100%" src="'.$model->image_path.'" alt="..." class="img-thumbnail mtl">
                </a>
                <div class="blog-preview-content">
                    <h3>
                        <a href="#">Blog Post Title</a>
                    </h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, quisquam, sunt, corporis.</p>
                    <div class="continue"><a href="#">Continue Reading →</a>
                    </div>
                    <ul class="meta list-inline">
                        <li>February 31, 2014</li>
                        <li>9 Comments</li>
                        <li><i class="fa fa-heart text-primary"></i> 12</li>
                    </ul>
                </div>
            </div>
        </div>
            ';
        },
    ]) ?>
    </div>
</div>

</section>


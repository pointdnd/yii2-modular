<div class="jumbotron text-center contact-default-index">
  <div class="container">
    <h1><?= $model->name ?></h1>
    <strong>Email:</strong> <?= $model->email ?> <br>
    <strong>Phone:</strong> <?= $model->phone ?> <br>
    <p>
        <?= $model->message ?>
    </p>
    <br>
    <a target="_blank" href="<?=y('.urlManager')->createAbsoluteUrl("products/packages/create",[
    	'email'=>$model->email,
    	'phone'=>$model->phone,
    	'owner'=>$model->name,
    	'name'=>"Creación de página web",
    	'message'=>"Creación de página web según la estrategia de diseño de nuestro cliente teniendo en cuenta ".$model->message,
	])?>">Responder</a>
  </div>
</div>


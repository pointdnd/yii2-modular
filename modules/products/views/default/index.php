<div class="jumbotron text-center products-default-index">
  <div class="container">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>  
    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
  </div>
</div>


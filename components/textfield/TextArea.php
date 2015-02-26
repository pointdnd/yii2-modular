<?php
namespace mii\components\textfield;

use mii\components\textfield\TextFieldAsset;
use yii\widgets\InputWidget;
use yii\helpers\Html;

class TextArea extends TextField
{

   /**
     * @var array the JQuery plugin options for the input mask plugin.
     * @see https://github.com/RobinHerbots/jquery.inputmask
     */
    public $allowed = 1000;
    
    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'form-control'];

    public function init()
    {
        // Your init task here
        parent::init();
    }

    /**
     * Executes the widget.
     * This method registers all needed client scripts and renders
     * the text field.
     */
    public function run()
    {
        $id = $this->options['id'];
        
        if(isset($this->options['name']))
            $name=$this->options['name'];
        
        $this->options['style']='height: 190px';
        
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    
    }
}

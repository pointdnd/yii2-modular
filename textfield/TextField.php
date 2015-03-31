<?php
namespace mii\textfield;

use mii\textfield\TextFieldAsset;
use yii\widgets\InputWidget;
use yii\helpers\Html;

class TextField extends InputWidget
{

   /**
     * @var array the JQuery plugin options for the input mask plugin.
     * @see https://github.com/RobinHerbots/jquery.inputmask
     */
    public $allowed = 255;
    
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
        
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    
    }


    /**
     * Registers the needed client script and options.
     */
    public function registerClientScript()
    {
        $id = $this->options['id'];
        $view = $this->getView();

        $warning=($this->allowed*15)/100;
        $js="
            $('#{$id}').charCount({
                allowed: {$this->allowed},        
                warning: {$warning},
                counterText: '/{$this->allowed}'  
            });
        ";
        
        $css="
            form .counter{
                font-size: 13px;
                font-weight: 700;
                color: #ccc;
            }
            form .warning{color:#600;}  
            form .exceeded{color:#e00;}
        ";
        
        TextFieldAsset::register($view);
        $view->registerCss($css);
        $view->registerJs($js); // \yii\web\View::POS_LOAD
    }
}
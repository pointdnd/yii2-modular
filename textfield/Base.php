<?php
namespace mii\widgets;

use mii\widgets\WidgetsInputAsset;
use yii\widgets\InputWidget;
use yii\helpers\Html;

class Base extends InputWidget
{

   /**
     * @var array the JQuery plugin options for the input mask plugin.
     * @see https://github.com/RobinHerbots/jquery.inputmask
     */
    public $clientOptions = [];
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
            echo Html::activeHiddenInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::hiddenInput($this->name, $this->value, $this->options);
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

        // Cliente options example
        // $this->initClientOptions();
        // if (!empty($this->mask)) {
        //     $this->clientOptions['mask'] = $this->mask;
        // }

        $js = '';
        //$js = '$("#' . $id . '").' . self::PLUGIN_NAME . "(" . $this->_hashVar . ");\n";
        WidgetsInputAsset::register($view);
        $view->registerCss();
        $view->registerJs($js); // \yii\web\View::POS_LOAD
    }

    protected function initClientOptions()
    {
        $options = $this->clientOptions;
        foreach ($options as $key => $value) {
            if (in_array($key, ['oncomplete', 'onincomplete', 'oncleared', 'onKeyUp', 'onKeyDown', 'onBeforeMask',
                    'onBeforePaste', 'onUnMask', 'isComplete', 'determineActiveMasksetIndex']) && !$value instanceof JsExpression
            ) {
                $options[$key] = new JsExpression($value);
            }
        }
        $this->clientOptions = $options;
    }
}
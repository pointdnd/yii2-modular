<?php
namespace mii\components\uploader;

use mii\components\uploader\UploadAsset;
use yii\widgets\InputWidget;
use yii\helpers\Html;

class Upload extends InputWidget
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



    public $typeError;
    public $sizeError;
    public $minSizeError;
    public $emptyError;
    public $onLeave;

    public $sizeValidate=array(); 
    public $actionUrl; // $this->createUrl('upload')
    public $containerCss='stick-image';
    public $buttonText='Seleccione un archivo';
    public $allowedExtensions=array('png','jpg','jpeg');
    public $templateSmall='Tamaño recomendado ({width}px X {height}px)';
    public $cssFile=false;
    public $iconButtom='fa-camera';
    public $imgContainerOptions=array();

    public $width='300';
    public $height='400';

    // @TODO Implementar extensiones y iconos
    public $iconExtensions=array('pdf'=>'fa fa-file-pdf-o fa-5x');

    public function init()
    {
        $this->typeError=\Yii::t('app',"Unfortunately the file(s) you selected weren't the type we were expecting. Only {extensions} files are allowed.");
        $this->sizeError=\Yii::t('app',"{file} is too large, maximum file size is {sizeLimit}.");
        $this->minSizeError=\Yii::t('app',"{file} is too small, minimum file size is {minSizeLimit}.");
        $this->emptyError=\Yii::t('app',"{file} is empty, please select files again without it.");
        $this->onLeave=\Yii::t('app',"The files are being uploaded, if you leave now the upload will be cancelled.");
        parent::init();
    }

    /**
     * Executes the widget.
     * This method registers all needed client scripts and renders
     * the text field.
     */
    public function run()
    {
        $uploadDir=\Yii::$app->urlManager->baseUrl.'/uploads';
        $id = $this->options['id'];
        
        if(isset($this->options['name']))
            $name=$this->options['name'];

        if($this->sizeValidate!==array() and isset($this->sizeValidate['width'],$this->sizeValidate['height']))
        {
            $this->width=$this->sizeValidate['width'];
            $this->height=$this->sizeValidate['height'];
            
            $textSmall=strtr($this->templateSmall,
                array('{width}'=>$this->sizeValidate['width'],
                    '{height}'=>$this->sizeValidate['height']));
            echo '<small class="text-muted">'.$textSmall.'</small>';
        }
        
        $img='';
        
        if(!$this->model->isNewRecord and !empty($this->model->{$this->attribute}))
            $img="<img id=\"jcrop_target{$id}\" class=\"img-responsive img-rounded\" src=\"{$uploadDir}/{$this->model->{$this->attribute}}\" alt=\"\">";
        
        $arrayFile=explode('.', $this->model->{$this->attribute});
        $ext = end($arrayFile);
        if(isset($this->iconExtensions[$ext])) {
            $filenamePreview = $this->iconExtensions[$ext];
            $img = "<div class=\"text-center\"><a href=\"{$uploadDir}/{$this->model->{$this->attribute}}\" target=\"_blank\"><i class=\"{$filenamePreview}\"></i></a></div>";
        }
        
        if(isset($this->imgContainerOptions['class']))
            $this->imgContainerOptions['class']=$this->imgContainerOptions['class']." {$this->containerCss} {$id}_img text-center";
        else
            $this->imgContainerOptions['class']="{$this->containerCss} {$id}_img text-center";
        $this->imgContainerOptions['data-url']="{$uploadDir}";

        
        $icon="";
        if($this->iconButtom!==false)
            $icon="<i class=\"fa {$this->iconButtom} mtl\" style=\"font-size: 10em;color: #f0f0f0\"></i>";
        if(!$this->model->isNewRecord and !empty($this->model->{$this->attribute}))
            $icon="";
        
        echo "<div class=\"tile qq-upload-extra-drop-area\">
        <div".Html::renderTagAttributes($this->imgContainerOptions).">
            {$img}
            {$icon}
        </div>
            <div id=\"{$id}_link\"></div>
        </div>";
        
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
        $params=$this->sizeValidate===array()?'{}':\yii\helpers\Json::encode($this->sizeValidate);
        $uploadDir=\Yii::$app->urlManager->baseUrl.'/uploads';
        $iconSmall="";
        if($this->iconButtom!==false)
            $iconSmall="<i class=\"fa {$this->iconButtom}\"></i>";
        
        $id = $this->options['id'];
        $view = $this->getView();

        $js="
                var uploader".strtr($id,array('-'=>''))." = new qq.FileUploader({
                element: document.getElementById('{$id}_link'),
                action: '{$this->actionUrl}',
                params: {$params},
                allowedExtensions: ".\yii\helpers\Json::encode($this->allowedExtensions).",
                dragText: '".\Yii::t('app','Drag and drog your file here')."',
                uploadButtonText: '<a class=\"btn btn-primary btn-large btn-block\" href=\"#\">{$iconSmall} {$this->buttonText}</a>',
                // debug: true,
                // multiple: false,
                extraDropzones: [qq.getByClass(document, 'qq-upload-extra-drop-area')[0]],
                hideShowDropArea: false,
                showMessage: function(message){
                    bootbox.alert(message);
                },
                messages: {
                    typeError: \"{$this->typeError}\",
                    sizeError: \"{$this->sizeError}\",
                    minSizeError: \"{$this->minSizeError}\",
                    emptyError: \"{$this->emptyError}\",
                    onLeave: \"{$this->onLeave}\"
                },
                fileTemplate: '<li>' +
                    '<span class=\"qq-progress-bar pls\"></span>' +
                    '<span class=\"qq-upload-file pls\"></span>' +
                    '<span class=\"qq-upload-spinner pls\"></span>' +
                    '<span class=\"qq-upload-size pls\"></span>' +
                    '<a class=\"qq-upload-cancel\" href=\"#\">{cancelButtonText}</a>' +
                    '<span class=\"qq-upload-failed-text\">{failUploadtext}</span>' +
                '</li>',
                onComplete: function(id, fileName, responseJSON){
                    if(responseJSON.success) {
                        var iconExtensions = ".\yii\helpers\Json::encode($this->iconExtensions).";
                        $('.{$this->containerCss}.{$id}_img').empty();
                        
                        var ext = responseJSON.fileName.split('.').pop();
                        var filenamePreview = responseJSON.fileName;
                        var html = '<img id=\"jcrop_target{$id}\" class=\"img-responsive img-rounded\" src=\"{$uploadDir}/'+filenamePreview+'\" alt=\"\">';
                        
                        if(iconExtensions[ext]) {
                            filenamePreview = iconExtensions[ext];
                            html = '<div class=\"text-center\"><a href=\"{$uploadDir}/'+responseJSON.fileName+'\" target=\"_blank\"><i class=\"'+filenamePreview+'\"></i></a></div>';
                        }
                        $('#{$id}').val(responseJSON.fileName);
                        $('.{$this->containerCss}.{$id}_img').html(html);
                    }
                },
            });
        
        ";
        // Cliente options example
        // $this->initClientOptions();
        // if (!empty($this->mask)) {
        //     $this->clientOptions['mask'] = $this->mask;
        // }

        // $js .= '$("#' . $id . '").' . self::PLUGIN_NAME . "(" . $this->_hashVar . ");\n";
        UploadAsset::register($view);
        $view->registerCss("    
            .qq-upload-list {
                /*display: none;*/
            }
            .qq-upload-failed-text {
                display: none;
            }
            .qq-upload-drop-area {
                text-align: center;
                color: #ccc;
                font-size: 0.9em;
                padding: 10px 0 10px 0;
            }
            .tile.qq-upload-extra-drop-area {
                border-radius: 8px;
                border: 6px #f0f0f0 dotted;
                min-height: 50px;
            }
        ");
        $view->registerJs($js,\yii\web\View::POS_LOAD);
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
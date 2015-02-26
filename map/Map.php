<?php
namespace mii\map;

use mii\map\MapFieldAsset;
use yii\widgets\InputWidget;
use yii\helpers\Html;

class Map extends InputWidget
{
    
    public $templateSmall='Puede seleccionar una dirección desde el mapa, dando clic ';
    
    public $iconButton='fa fa-map-marker';
    public $readonly=false;
    public $searchWithDepartament=false;
    

    /*
     * @imgIcon
     * In this attribute you can send
     * absolute or relatyve url for icon 
     * for marker
     * if you have your icon on your img dir:
     * 
     * ...
     * 'imgIcon'=>Yii::app()->request->baseUrl.'/img/myicon.png',
     * ...
     * 
     * 
     * Or if you have your icon on your theme folder
     * ...
     * 'imgIcon'=>Yii::app()->theme->baseUrl.'/img/myicon.png',
     * ...
    */
    public $imgIcon;

    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'form-control'];

    /**
     * Executes the widget.
     * This method registers all needed client scripts and renders
     * the text field.
     */
    public function run()
    {
        $id = $this->options['id'];
        if($this->imgIcon!==null)
            $imageIcon=$this->imgIcon;
        else
            $imageIcon=\Yii::getAlias('@web').'/img/tag.png';
        
        if(isset($this->options['name']))
            $name=$this->options['name'];
        
        $this->registerClientScript();

        $this->options["class"]="form-control";
        if($this->readonly)
            $this->options["readonly"]="readonly";
        
        $idLat=strtr("{$id}",array(get_class($this->model)."_"=>""))."_lat";
        $idLng=strtr("{$id}",array(get_class($this->model)."_"=>""))."_lng";
        $idPath=strtr("{$id}",array(get_class($this->model)."_"=>""))."_lng";
        

        $idLat = Html::getInputId($this->model,$this->attribute."_lat");
        $idLng = Html::getInputId($this->model,$this->attribute."_lng");
        $idPath = Html::getInputId($this->model,$this->attribute."_path");

        $valLat='';     
        if(isset($this->model->{$idLat}))
            $valLat=$this->model->{$idLat};

        $valLng='';     
        if(isset($this->model->{$idLng}))
            $valLng=$this->model->{$idLng};     
        
        // @TODO hacer editable el path es un array
        $valPath='';        
        // if(isset($this->model->path))
        //  $valLng=$this->model->path;
        
        $valAddress='';
        if(isset($this->model->{$this->attribute}))
            $valAddress=$this->model->{$this->attribute};
        
        echo "<small class=\"text-muted\"><em>{$this->templateSmall} <a href=\"#\" id=\"{$id}_button\" class=\"\"> aquí <i class=\"fa fa-map-marker\"></i></a></em></small>";
        echo Html::activeTextInput($this->model,$this->attribute,$this->options);
        
        $baseNameLat = Html::getInputName($this->model,$this->attribute."_lat");
        $baseNameLng = Html::getInputName($this->model,$this->attribute."_lng");
        $baseNamePath = Html::getInputName($this->model,$this->attribute."_path");

        echo "<input value=\"{$valLat}\" type=\"hidden\" id=\"{$id}_lat\" name=\"".$baseNameLat."\">";
        echo "<input value=\"{$valLng}\" type=\"hidden\" id=\"{$id}_long\" name=\"".$baseNameLng."\">";
        echo "<input value=\"{$valPath}\" type=\"hidden\" id=\"{$id}_path\" name=\"".$baseNamePath."\">";

                echo "<div class=\"modal fade\" id=\"{$id}_modal\" tabindex=\"-1\" role=\"{$id}_modal\" aria-hidden=\"true\">
        <div class=\"modal-dialog\" style=\"width: auto;\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                    <h4 class=\"modal-title\"><i class=\"fa fa-map-marker\"></i> Ubicar dirección en el mapa</h4>
                </div>
                <div class=\"modal-body\">
                    <div class=\"input-group\">
                        <span class=\"input-group-addon\">
                            <a href=\"#\" id=\"{$id}_ttext\"></a> > <a href=\"#\" id=\"{$id}_dtext\"></a>
                        </span>
                    <input type=\"text\" id=\"{$id}_address\" value=\"{$valAddress}\" placeholder=\"Digíta una dirección o lugar - Ej: Calle 85 Carrera 90\" class=\"form-control\">
                        <span class=\"input-group-btn\">
                            <a href=\"#\" id=\"{$id}_search\" class=\"btn btn-primary\"><i class=\"fa fa-search\"></i> Buscar</a>
                            <a href=\"#\" id=\"{$id}_close\" class=\"btn btn-primary\"><i class=\"fa fa-map-marker\"></i> Listo</a>
                            <a href=\"#\" id=\"{$id}_draw\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i> Dibujar cuadrante</a>
                        </span> 
                    </div>
                
                    <br>
                    <div data-img=\"{$imageIcon}\" style=\"width:100%;height:500px\" id=\"{$id}_map\"></div>
                </div>
                </div>
            </div>
        </div>";
        
    
    }


    /**
     * Registers the needed client script and options.
     */
    public function registerClientScript()
    {
        $id = $this->options['id'];
        $view = $this->getView();

        $js = "
            /*-----------------------REPORTAR EVENTO EN EL MAPA {$id}-----------------------------------*/
            //Actios Eventos
            $(function() {

                $('#{$id}_modal').on('shown.bs.modal', function (e) {
                    crearevento('{$id}');
                    setTimeout(function(){
                        $('#{$id}_address').focus();
                    }, 1);
                })
                $(document).on('click','#{$id}_button, #{$id}',function(e) {
                    e.preventDefault();
                    $('#{$id}_modal').modal('show');
                });
                $(document).on('click','#{$id}_close',function(e) {
                    e.preventDefault();
                    if($('#{$id}_address').val()=='') {
                        bootbox.alert('Por favor digíta una dirección o lugar - Ej: Calle 85 Carrera 90<br> Al digitar la dirección presione enter o clic en buscar, Esta dirección buscará en la ciudad y departamento seleccionada previamente.');
                    } else {
                        $('#{$id}').val($('#{$id}_address').val());
                        $('#{$id}_modal').modal('hide');
                    }
                });
            });
        ";
        MapFieldAsset::register($view);
        $view->registerJs($js,\yii\web\View::POS_END); // \yii\web\View::POS_LOAD
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
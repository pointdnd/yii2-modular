<?php

namespace mii\modules\dashboard;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'mii\modules\dashboard\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public function getMenuAdmin()
    {
        return array(
            array('label'=>'Dashboard', 'icon'=>'fa fa-laptop', 'url'=>['/'.$this->id]),
        );
    }
}
